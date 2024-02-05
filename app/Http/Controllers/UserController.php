<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $pengguna = User::get();
        
        return view('user.index', ['judul' => 'Pengguna', 'pengguna' => $pengguna]);
    }

    public function show($id)
    {
        $pengguna = User::with('roles')->findOrFail($id);
        $peran = Role::get();

        return view('user.detail', ['judul' => 'Pengguna ' . $id, 'pengguna' => $pengguna, 'peran' => $peran]);
    }

    public function create()
    {
        return view('user.add', ['judul' => 'Tambah Pengguna']);
    }

    public function store(Request $request)
    {
        $pengguna = new User;

        $pengguna->username = $request->namapengguna;
        $pengguna->name = $request->nama;
        $pengguna->email = $request->surel;
        $pengguna->password = $request->katasandi;
        $pengguna->status = ($request->status == 'on') ? 1 : 0;
        $pengguna->profile_picture = $request->foto;
        $pengguna->remember_token = csrf_token();
        $pengguna->save();

        return redirect('/user');
    }

    public function edit($id)
    {
        $pengguna = User::findOrFail($id);

        return view('user.edit', ['judul' => 'Sunting Pengguna ' . $id, 'pengguna' => $pengguna]);
    }

    public function update(Request $request, $id)
    {
        $pengguna = User::findOrFail($id);

        $pengguna->username = $request->namapengguna;
        $pengguna->name = $request->nama;
        $pengguna->email = $request->surel;
        $pengguna->status = ($request->status == 'on') ? 1 : 0;
        $pengguna->save();

        return redirect('/user');
    }
}