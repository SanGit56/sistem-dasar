<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    public function show(Request $request)
    {
        $kata_kunci = $request->cari;
        $menu = Menu::where('name', 'LIKE', '%'.$kata_kunci.'%')
                    ->orWhere('description', 'LIKE', '%'.$kata_kunci.'%')
                    ->paginate(7);
        
        return view('menu.index', ['judul' => 'Menu', 'menu' => $menu]);
    }

    public function create()
    {
        return view('menu.add', ['judul' => 'Tambah Menu']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:32',
            'description' => 'max:64'
        ]);

        $menu = Menu::create($request->all());

        if ($menu) {
            Log::channel('data')->info(Auth::user()->username . ' menambah data menu ' . $request->name);
            
            Session::flash('pesan', 'berhasil menambah data');
        } else {
            Session::flash('pesan', 'gagal menambah data');
        }

        return redirect('/menu');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);

        return view('menu.edit', ['judul' => 'Sunting Menu ' . $id, 'menu' => $menu]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:32',
            'description' => 'max:64'
        ]);

        $menu = Menu::findOrFail($id);

        $menu->update($request->all());

        if ($menu) {
            Log::channel('data')->info(Auth::user()->username . ' menyunting data menu ' . $request->name);

            Session::flash('pesan', 'berhasil mengubah data');
        } else {
            Session::flash('pesan', 'gagal mengubah data');
        }
        return redirect('/menu');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        $menu->delete();

        if ($menu) {
            Log::channel('data')->info(Auth::user()->username . ' menghapus data menu ' . $menu->name);

            Session::flash('pesan', 'berhasil menghapus data');
        } else {
            Session::flash('pesan', 'gagal menghapus data');
        }

        return redirect('/menu');
    }

    public function trash()
    {
        $menu = Menu::onlyTrashed()->get();

        return view('menu.deleted', ['judul' => 'Menu Terhapus', 'menu' => $menu]);
    }

    public function restore($id)
    {
        $menu = Menu::withTrashed()->where('id', $id)->restore();

        if ($menu) {
            Log::channel('data')->info(Auth::user()->username . ' mengembalikan data menu');

            Session::flash('pesan', 'berhasil memulihkan data');
        } else {
            Session::flash('pesan', 'gagal memulihkan data');
        }

        return redirect('/menu-deleted');
    }
}