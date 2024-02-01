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
}