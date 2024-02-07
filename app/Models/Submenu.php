<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Submenu extends Model
{
    use HasFactory, SoftDeletes;

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}