<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Submenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubmenuController extends Controller
{
    public function show(Request $request)
    {
        $kata_kunci = $request->cari;
        $submenu = Submenu::where('name', 'LIKE', '%'.$kata_kunci.'%')->paginate(7);
        
        return view('submenu.index', ['judul' => 'Submenu', 'submenu' => $submenu]);
    }

    public function create()
    {
        $menu = Menu::select('id', 'name')->get();
        
        return view('submenu.add', ['judul' => 'Tambah Submenu', 'menu' => $menu]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'menu_id' => 'required',
            'name' => 'required|max:32',
            'position' => 'required|max:4'
        ]);

        $submenu = new Submenu();

        $submenu->menu_id = $request->menu_id;
        $submenu->name = $request->name;
        $submenu->position = $request->position;
        $submenu->is_active = ($request->aktif == 'on') ? 1 : 0;
        $submenu->save();

        if ($submenu) {
            Session::flash('pesan', 'berhasil menambah data');
        } else {
            Session::flash('pesan', 'gagal menambah data');
        }

        return redirect('/submenu');
    }

    public function edit($id)
    {
        $submenu = Submenu::findOrFail($id);
        $menu = Menu::select('id', 'name')->get();
        
        return view('submenu.edit', ['judul' => 'Sunting Submenu ' . $id, 'submenu' => $submenu, 'menu' => $menu]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'menu_id' => 'required',
            'name' => 'required|max:32',
            'position' => 'required|max:4'
        ]);

        $submenu = Submenu::findOrFail($id);

        $submenu->menu_id = $request->menu;
        $submenu->name = $request->nama;
        $submenu->position = $request->posisi;
        $submenu->is_active = ($request->aktif == 'on') ? 1 : 0;
        $submenu->save();

        if ($submenu) {
            Session::flash('pesan', 'berhasil mengubah data');
        } else {
            Session::flash('pesan', 'gagal mengubah data');
        }

        return redirect('/submenu');
    }

    public function destroy($id)
    {
        $submenu = Submenu::findOrFail($id);

        $submenu->delete();

        if ($submenu) {
            Session::flash('pesan', 'berhasil menghapus data');
        } else {
            Session::flash('pesan', 'gagal menghapus data');
        }

        return redirect('/submenu');
    }

    public function trash()
    {
        $submenu = Submenu::onlyTrashed()->get();

        return view('submenu.deleted', ['judul' => 'Submenu Terhapus', 'submenu' => $submenu]);
    }

    public function restore($id)
    {
        $submenu = Submenu::withTrashed()->where('id', $id)->restore();

        if ($submenu) {
            Session::flash('pesan', 'berhasil memulihkan data');
        } else {
            Session::flash('pesan', 'gagal memulihkan data');
        }

        return redirect('/submenu-deleted');
    }
}