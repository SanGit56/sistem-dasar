<?php

namespace App\Http\Controllers;

use App\Models\Submenu;
use Illuminate\Http\Request;

class SubmenuController extends Controller
{
    public function show()
    {
        $submenu = Submenu::get();
        
        return view('submenu.index', ['judul' => 'Submenu', 'submenu' => $submenu]);
    }
}