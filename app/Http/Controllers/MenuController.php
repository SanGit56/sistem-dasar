<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    public function show()
    {
        $menu = Menu::get();
        
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
            Session::flash('pesan', 'berhasil mengubah data');
        } else {
            Session::flash('pesan', 'gagal mengubah data');
        }
        return redirect('/menu');
    }
}