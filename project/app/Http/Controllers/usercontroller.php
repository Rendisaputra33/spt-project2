<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;

class usercontroller extends Controller
{
    public function index()
    {
        return view('tampil-data-user');
    }
    // method to delete data user
    public function deleteMethod($id)
    {
        return user::where('id_user', $id)->delete()
            ? redirect()->back()->with('sukses', 'data berhasil di hapus')
            : redirect()->back()->with('error', 'data gagal di hapus');
    }
    // method prosesing request update
    public function updateMethod(Request $req, $id)
    {
        $data = user::where('username', $req->uusername)->first();
        if ($data !== null) {
            if ($data->username === $req->uusername && $data->id_user === (int) $id) {
                return $this->saveUpdate($req, $id);
            } elseif ($data->id_user !== (int) $id) {
                return redirect()->back()->with('gagal', 'username telah dipakai');
            } else {
                return $this->saveUpdate($req, $id);
            }
        } else {
            return $this->saveUpdate($req, $id);
        }
    }
    // method save update
    public function saveUpdate($req, $id)
    {
        return User::where('id_user', $id)->update([
            'nama' => $req->unama_user,
            'username' => $req->uusername,
            'passowrd' => bcrypt($req->upassword),
            'level' => $req->ulevel
        ])
            ? redirect('/user')->with('sukses', 'data berhasil di update')
            : redirect()->back()->with('error', 'data gagal di update');
    }
    // get data update for update data user
    public function getupMethod()
    {
        return response()->json([
            'data' => user::where('id_user', request('id'))->first()
        ]);
    }
}
