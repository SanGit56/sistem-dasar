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

    public function edit($id)
    {
        $peran = Role::findOrFail($id);

        return view('role.edit', ['judul' => 'Sunting Peran ' . $id, 'peran' => $peran]);
    }

    public function update(Request $request, $id)
    {
        $peran = Role::findOrFail($id);

        $peran->update($request->all());

        return redirect('/role');
    }
}