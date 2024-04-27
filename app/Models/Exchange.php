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
        return $this->belongsTo(User::class, 'user_id');
    }

    public function otherUser()
    {
        return $this->belongsTo(User::class, 'other_user_id');
    }

    public function userGoods()
    {
        return $this->belongsTo(Goods::class, 'user_goods_id');
    }

    public function otherUserGoods()
    {
        return $this->belongsTo(Goods::class, 'other_user_goods_id');
    }
}
