<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function show()
    {
        $menu = Menu::with('roles')->get();
        
        return view('menu.index', ['judul' => 'Menu', 'menu' => $menu]);
    }
}