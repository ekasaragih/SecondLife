<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the community post that the like belongs to.
     */
    public function community()
    {
        return $this->belongsTo(Communities::class, 'community_ID', 'community_ID');
    }
}
