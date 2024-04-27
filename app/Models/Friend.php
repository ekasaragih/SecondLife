<?php

// app/Models/Follower.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    public function friend()
    {
        return $this->hasOne(User::class, 'friend_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
