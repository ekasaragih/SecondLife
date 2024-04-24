<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SwapeWishlist extends Model
{
    protected $table = 'wishlist';

    protected $primaryKey = 'wishlist_ID';

    protected $fillable = [
        'g_ID', 'us_ID', 'created_at', 'updated_at'
    ];
}
