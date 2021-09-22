<?php

namespace App\Http\Controllers;

use App\Models\entry;
use App\Models\pengirim;
use Illuminate\Http\Request;

class hppcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(entry $entry)
    {
        return view('cek-hpp', [
            'data' => $entry->whereNull('hpp')->orderBy('id_entry', 'desc')->get(),
            'title' => 'Cek HPP',
            'pengirim' => pengirim::orderBy('id_pengirim', 'desc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, entry $entry)
    {
        $id = $request->id;
        return $entry->where('id_entry', $id)->update([
            'hpp' => $request->hpp,
            'keterangan' => $request->pengirim
        ]) ? redirect()->back() : redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function show($id, entry $entry)
    {
        return response()->json([
            'data' => $entry->select('hpp', 'id_entry', 'keterangan')->where('id_entry', $id)->first()
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, entry $entry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(entry $entry)
    {
        //
    }
}
