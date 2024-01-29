<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        $pengguna = User::with('roles')->get();
        
        return view('user.index', ['judul' => 'Pengguna', 'pengguna' => $pengguna]);
    }
}