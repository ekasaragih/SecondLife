<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;


class Wishlist extends Model
{
    use HasFactory;
    protected $table = 'wishlist';
    protected $primaryKey = 'wishlist_ID';

    protected $fillable = [
        'g_ID',
        'us_ID',
    ];

    public function goods(): BelongsTo
    {
        return $this->belongsTo(Goods::class, 'g_ID', 'g_ID');
    }

    public function userID(): BelongsTo
    {
        return $this->belongsTo(User::class, 'us_ID');
    }

    public function owner(): HasOneThrough
    {
        return $this->hasOneThrough(User::class, Goods::class, 'g_ID', 'id', 'g_ID', 'us_ID');
    }
}
