<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wishlist extends Model
{
    use HasFactory;
    protected $table = 'wishlist';

    protected $fillable = [
        'g_ID',
        'us_ID',
    ];

    public function goods(): BelongsTo
    {
        return $this->belongsTo(Goods::class, 'g_ID', 'g_ID');
    }

    public function userID()
    {
        return $this->belongsTo(User::class, 'us_ID');
    }
}
