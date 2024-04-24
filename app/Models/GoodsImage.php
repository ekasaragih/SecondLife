<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GoodsImage extends Model
{
    protected $primaryKey = 'img_ID';
    protected $table = 'goods_image';

    protected $fillable = [
        'img_url',
        'g_ID',
        'us_ID',
    ];

    // Definisikan relasi dengan model Goods
    public function goods(): BelongsTo
    {
        return $this->belongsTo(Goods::class, 'g_ID');
    }
}
