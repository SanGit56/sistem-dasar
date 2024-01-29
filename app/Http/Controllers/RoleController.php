<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function show()
    {
        $peran = Role::with(['users', 'menus'])->get();
        
        return view('role.index', ['judul' => 'Peran', 'peran' => $peran]);
    }
}