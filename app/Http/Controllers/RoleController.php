<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function show()
    {
        $peran = Role::all();
        
        return view('role.index', ['peran' => $peran]);
    }
}