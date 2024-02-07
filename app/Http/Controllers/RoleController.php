<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    public function show(Request $request)
    {
        $kata_kunci = $request->cari;
        $peran = Role::where('name', 'LIKE', '%'.$kata_kunci.'%')
                    ->orWhere('description', 'LIKE', '%'.$kata_kunci.'%')
                    ->paginate(7);
        
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

    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        $role->delete();

        if ($role) {
            Session::flash('pesan', 'berhasil menghapus data');
        } else {
            Session::flash('pesan', 'gagal menghapus data');
        }

        return redirect('/role');
    }

    public function trash()
    {
        $peran = Role::onlyTrashed()->get();

        return view('role.deleted', ['judul' => 'Peran Terhapus', 'peran' => $peran]);
    }

    public function restore($id)
    {
        $peran = Role::withTrashed()->where('id', $id)->restore();

        if ($peran) {
            Session::flash('pesan', 'berhasil memulihkan data');
        } else {
            Session::flash('pesan', 'gagal memulihkan data');
        }

        return redirect('/role-deleted');
    }
}