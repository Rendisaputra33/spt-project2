<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;

class authcontroller extends Controller
{
    // check user is already exist or not
    public function getUser($username)
    {
        $data = user::where('username', $username)->first();
        return $data === null
            ? ['fail' => true]
            : ['data' => [
                'username' => $data->username,
                'password' => $data->password,
                'nama' => $data->nama,
                'level' => $data->level
            ]];
    }
    // authenticate user login
    public function login(Request $req)
    {
        $checkaccount = $this->getUser($req->username);

        if (isset($checkaccount['fail'])) {
            return redirect()->back()->with('error', 'username tidak terdaftar!');
        }

        if (!password_verify($req->password, $checkaccount['data']['password'])) {
            return redirect()->back()->with('error', 'password salah!');;
        }

        $this->createSession($req, $checkaccount['data']);
        return redirect('dashbord');
    }
    // create user session
    private function createSession($req, $data)
    {
        $req->session()->put('username', $data['username']);
        $req->session()->put('user_id', $data['id_user']);
        $req->session()->put('name', $data['nama']);
        $req->session()->put('role', $data['level']);
    }
}
