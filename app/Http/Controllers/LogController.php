<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function show()
    {
        $catatan = Log::with('user')->get();
        
        return view('log.index', ['judul' => 'Catatan', 'catat' => $catatan]);
    }
}