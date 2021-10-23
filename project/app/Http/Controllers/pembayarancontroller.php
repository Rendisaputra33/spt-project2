<?php

namespace App\Http\Controllers;

use App\Http\Utility\PembayaranUtil;
use App\Models\entry;
use App\Models\pembayaran;
use App\Models\pengirim;
use Illuminate\Http\Request;

class pembayarancontroller extends Controller
{
    protected $util;

    public function __construct()
    {
        $this->util = new PembayaranUtil(new pembayaran());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(pembayaran $pembayaran)
    {
        return view('tampil-data-pembayaran', [
            'title' => 'Pembayaran',
            'pembayaran' => $pembayaran->getPembayaran()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(pembayaran $pembayaran, $data)
    {
        return $pembayaran->insert($data)
            ? redirect('/pembayaran/transaksi/report?invoice=' . $data[0]['invoice'])->with('sukses', 'pembayaran berhasil')
            : redirect('/pembayaran')->with('error', 'pembayaran gagal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, pembayaran $pembayaran, entry $entry)
    {
        if ($request->id === null) :
            return redirect()->back()->with('error', 'pilih data yang akan di bayar terlebih dahulu');
        endif;
        // create new invoice
        $invoice = $this->util->createInvoice();
        // get a data entry
        $recource = $entry->whereIn('id_entry', $request->id)->get();
        // mapping data
        $data = $recource->map(function ($ent) use ($invoice) {
            return [
                'invoice' => $invoice,
                'total' => 0,
                'id_entry' => $ent->id_entry
            ];
        })->toArray();

        return $this->create($pembayaran, $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function show(pembayaran $pembayaran, entry $entry)
    {
        // get all id entry from pembayaran
        $ids = $pembayaran->select('id_entry')->get();
        // send data entry to view
        return view('tambah-pembayaran', [
            'data' => $entry->whereNotIn('id_entry', $ids)->whereNotNull('harga_beli')->whereNotNull('keterangan')->join('mstr_pengirim', 'entry.keterangan', 'mstr_pengirim.id_pengirim')->get(),
            'pengirim' => pengirim::orderBy('id_pengirim', 'DESC')->get(),
            'title' => 'Tambah Pembayaran'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit(entry $entry, Request $request, $id)
    {
        //
        return $entry->where('id_entry', $id)->update([
            'harga_beli' => $request->harga
        ]) ? redirect()->back() : redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pembayaran $pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(pembayaran $pembayaran, $invoice)
    {
        return $pembayaran->where('invoice', str_replace('-', '/', $invoice))->delete()
            ? redirect()->back()->with('sukses', 'data berhasil di hapus')
            : redirect()->back()->with('error', 'data gagal di hapus');
    }

    /**
     * Check data with harga beli equals to null
     * 
     * @param \App\Models\entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function cekHarga(entry $entry)
    {
        return view('cek-harga-beli', [
            'title' => 'Cek Harga',
            'data' => $entry->whereDate('entry.created_at', now())->join('mstr_pengirim', 'entry.keterangan', 'mstr_pengirim.id_pengirim')->get()
        ]);
    }

    /**
     * Check data with harga beli equals to null
     * 
     * @param \App\Models\entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function detail(entry $entry, $invoice)
    {
        // get all id with invoice equals $invoice
        $recource = pembayaran::select('id_entry')->where('invoice', str_replace('-', '/', $invoice))->get();
        // return single data entry
        return response()->json([
            'data' => $entry->whereIn('id_entry', $recource)->get()
        ]);
    }

    /**
     * Get data with pengirim equals to $request['pengirim']
     * 
     * @param \App\Models\entry  $entry
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request, entry $entry)
    {
        $ids = pembayaran::select('id_entry')->get();
        // get data from database
        $data = $entry->where('keterangan', $request->pengirim)->whereNotIn('id_entry', $ids)->whereNotNull('keterangan')->whereNotNull('harga_beli')
            ->join('mstr_pengirim', 'entry.keterangan', 'mstr_pengirim.id_pengirim')->get();
        // return data entry with keterangan equals $request['keterangan']
        return response()->json(['data' => $data]);
    }

    /**
     * Create report for transaksi
     * 
     * @param \App\Models\entry  $entry
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function report(Request $req, pembayaran $payment, entry $entry)
    {
        // select invoice from query parameter url
        $invoice = $req->input('invoice');
        // put data pembayaran with same invoice
        $listPembayaran = $payment->select('id_entry', 'created_at')->where('invoice', $invoice)->get()->toArray();
        // put data transaksi with id_entry in $listPembayaran
        $listTransaksi = $entry->whereIn('id_entry', array_column($listPembayaran, 'id_entry'))->get();
        // return view report to user
        return view('cetak-harga-beli', [
            'title' => 'Cetak Pembayaran',
            'data' => $listTransaksi,
            'tanggal_bayar' => $listPembayaran[0]['created_at'],
            'invoice' => $invoice
        ]);
    }

    // 
    public function filterTanggal(Request $request, pembayaran $pembayaran)
    {
        return response()->json([
            'data' => $pembayaran->filterPembayaran([$request->tgl1, $request->tgl2]),
        ]);
    }

    // 
    public function filterTanggalCek(Request $request)
    {
        return response()->json([
            'data' => entry::whereBetween('created_at', [$request->tgl1, $request->tgl2])->whereNotNull('keterangan')->get()
        ]);
    }

    // 
    public function globalReport(pembayaran $pembayaran)
    {
        return view('laporan-pembayaran', [
            'title' => 'Laporan Pembayaran',
            'data' => $pembayaran->getPembayaran()
        ]);
    }

    // 
    public function viewUpdate(pembayaran $pembayaran)
    {
        // get all id entry from pembayaran
        $ids = $pembayaran->select('id_entry')->get();
        //  
        return view('update-harga', [
            'data' => entry::whereNotIn('id_entry', $ids)->whereNull('harga_beli')->join('mstr_pengirim', 'entry.keterangan', 'mstr_pengirim.id_pengirim')->get()
        ]);
    }
}
