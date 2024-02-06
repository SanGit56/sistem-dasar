<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $validated = $request->validate([
            'name' => 'required|max:32',
            'description' => 'max:64'
        ]);

        $peran = Role::create($request->all());

        if ($peran) {
            Session::flash('pesan', 'berhasil menambah data');
        } else {
            Session::flash('pesan', 'gagal menambah data');
        }

        return redirect('/role');
    }

    public function edit($id)
    {
        $peran = Role::findOrFail($id);

        return view('role.edit', ['judul' => 'Sunting Peran ' . $id, 'peran' => $peran]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:32',
            'description' => 'max:64'
        ]);

        $peran = Role::findOrFail($id);

        $peran->update($request->all());

        if ($peran) {
            Session::flash('pesan', 'berhasil mengubah data');
        } else {
            Session::flash('pesan', 'gagal mengubah data');
        }

        return redirect('/role');
    }
}