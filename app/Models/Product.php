<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi lewat form
    protected $fillable = [
        'nama',
        'harga',
        'deskripsi',
        'stok',
        'toko'
    ];
}