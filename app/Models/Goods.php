<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Goods extends Model
{
    use HasFactory;

    protected $table = 'goods';
    protected $primaryKey = 'g_ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'g_ID',
        'us_ID',
        'g_name',
        'g_desc',
        'g_type',
        'g_original_price',
        'g_age',
        'g_category',
    ];

    public function userID()
    {
        return $this->belongsTo(User::class, 'us_ID');
    }

    public function images(): HasMany
    {
        return $this->hasMany(GoodsImage::class, 'g_ID');
    }

    public static function getAllGoodsWithImages()
    {
        return self::with('images')->get();
    }

    public function wishlist(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'g_ID');
    }

    public function goodsImages(): HasMany
    {
        return $this->hasMany(GoodsImage::class, 'g_ID');
    }

    public function isExchanged()
    {
        return Exchange::where('my_goods', $this->g_ID)->orWhere('barter_with', $this->g_ID)->exists();
    }

    public function exchanges(): BelongsToMany
    {
        return $this->belongsToMany(Exchange::class, 'exchange', 'my_goods', 'barter_with');
    }

}
