<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $table = 'wishlists'; // Sesuaikan dengan nama tabel di database jika berbeda

    protected $fillable = [
        'g_ID', // ID produk
        'us_ID', // ID pengguna
    ];

    // Tambahkan relasi ke model produk jika diperlukan
    public function product()
    {
        return $this->belongsTo(Product::class, 'g_ID');
    }
}
