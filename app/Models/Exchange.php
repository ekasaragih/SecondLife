<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    use HasFactory;

    protected $table = 'exchange';
    protected $primaryKey = 'ex_ID';

    protected $fillable = [
        'my_ID',
        'goods_owner_ID',
        'my_goods',
        'barter_with',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'my_ID');
    }

    public function otherUser()
    {
        return $this->belongsTo(User::class, 'goods_owner_ID');
    }

    public function userGoods()
    {
        return $this->belongsTo(Goods::class, 'my_goods');
    }

    public function otherUserGoods()
    {
        return $this->belongsTo(Goods::class, 'barter_with');
    }
}
