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
        'requested_by',
        'goods_owner_ID',
        'my_goods',
        'barter_with',
        'status',
        'meet_up_at',
        'exchanged_at',
        'reason_reject',
        'confirmed_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'requested_by');
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
