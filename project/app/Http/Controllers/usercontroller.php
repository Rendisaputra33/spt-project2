<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;

class usercontroller extends Controller
{
    public function indexMethod()
    {
        return view('tampil-data-user', [
            'title' => 'User',
            'data' => user::get()
        ]);
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
        $data = user::where('username', $req->username)->first();
        if ($data !== null) {
            if ($data->username === $req->username && $data->id_user === (int) $id) {
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
        return user::where('id_user', $id)->update([
            'nama' => $req->nama,
            'username' => $req->username,
            'password' => bcrypt($req->password),
            'level' => $req->level
        ])
            ? redirect('/user')->with('sukses', 'data berhasil di update')
            : redirect()->back()->with('error', 'data gagal di update');
    }
    // get data update for update data user
    public function getupMethod($id)
    {
        return response()->json([
            'data' => user::where('id_user', $id)->first()
        ]);
    }

    public function searchMethod($s)
    {
        return response()->json([
            'data' => user::where('nama', 'LIKE', '%' . $s . '%')
                ->orWhere('username', 'LIKE', '%' . $s . '%')
                ->orWhere('level', 'LIKE', '%' . $s . '%')
                ->get()
        ]);
    }
}
