<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

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
        Menu::create($request->all());

        return redirect('/menu');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);

        return view('menu.edit', ['judul' => 'Sunting Menu ' . $id, 'menu' => $menu]);
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $menu->update($request->all());

        return redirect('/menu');
    }
}