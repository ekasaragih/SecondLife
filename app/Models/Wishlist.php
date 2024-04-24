<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $table = 'wishlist';

    protected $fillable = [
        'g_ID',
        'us_ID',
    ];

    public function product()
    {
        return $this->belongsTo(Goods::class, 'g_ID');
    }
}
