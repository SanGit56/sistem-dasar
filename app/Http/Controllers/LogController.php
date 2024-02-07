<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function show(Request $request)
    {
        $kata_kunci = $request->cari;
        $catatan = Log::where('user_id', 'LIKE', '%'.$kata_kunci.'%')
                    ->orWhere('description', 'LIKE', '%'.$kata_kunci.'%')
                    ->paginate(7);
        
        return view('log.index', ['judul' => 'Catatan', 'catat' => $catatan]);
    }
}