<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        $pengguna = User::all();
        
        return view('user.index', ['judul' => 'Pengguna', 'pengguna' => $pengguna]);
    }
}