<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    // kalau nama tabel di DB bukan 'categories', set manual:
    protected $table = 'categoryes'; // atau 'categories' sesuai real di DB
}
