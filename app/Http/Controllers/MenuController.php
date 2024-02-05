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
}