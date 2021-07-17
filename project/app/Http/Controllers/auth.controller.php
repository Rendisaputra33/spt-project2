<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;

class authcontroller extends Controller
{
    // check user is already exist or not
    public function getUser(string $username)
    {
        // find username found or not
        $data = user::where('username', $username)->first();
        // return data
        return $data === null
            ? ['fail' => true]
            : ['data' => [
                'id_user' => $data->id_user,
                'username' => $data->username,
                'password' => $data->password,
                'nama' => $data->nama,
                'level' => $data->level
            ]];
    }
    // register user / add account user
    public function register(Request $req)
    {
        $checkaccount = $this->getUser($req->username);
        // check username already exist or not
        if (!isset($checkaccount['fail'])) {
            return redirect()->back()->with('error', 'username telah terdaftar!');
        }
        // insert data and redirect
        return user::insert([
            'username' => $req->username,
            'nama' => $req->nama,
            'password' => bcrypt($req->password),
            'level' => $req->level
        ]) ? redirect()->back()->with('sukses', 'data user berhasil ditambah')
            : redirect()->back()->with('error', 'username telah terdaftar!');
    }
    // authenticate user login
    public function login(Request $req)
    {
        $checkaccount = $this->getUser($req->username);
        // check username already exist or not
        if (isset($checkaccount['fail'])) {
            return redirect()->back()->with('error', 'username tidak terdaftar!');
        }
        // check password wo=rong or not
        if (!password_verify($req->password, $checkaccount['data']['password'])) {
            return redirect()->back()->with('error', 'password salah!');;
        }
        // set user session end redirect to dashboard
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
