<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Submenu;
use Illuminate\Http\Request;

class SubmenuController extends Controller
{
    public function show()
    {
        $submenu = Submenu::get();
        
        return view('submenu.index', ['judul' => 'Submenu', 'submenu' => $submenu]);
    }

    public function create()
    {
        $menu = Menu::select('id', 'name')->get();
        
        return view('submenu.add', ['judul' => 'Tambah Submenu', 'menu' => $menu]);
    }

    public function store(Request $request)
    {
        $submenu = new Submenu();

        $submenu->menu_id = $request->menu;
        $submenu->name = $request->nama;
        $submenu->position = $request->posisi;
        $submenu-> 	is_active = ($request->aktif == 'on') ? 1 : 0;
        $submenu->save();

        return redirect('/submenu');
    }
}