<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function show()
    {
        $peran = Role::get();
        
        return view('role.index', ['judul' => 'Peran', 'peran' => $peran]);
    }

    public function create()
    {
        return view('role.add', ['judul' => 'Tambah Peran']);
    }

    public function store(Request $request)
    {
        Role::create($request->all());

        return redirect('/role');
    }
}