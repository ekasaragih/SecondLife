<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Communities extends Model
{
    use HasFactory;

    protected $table = 'communities';
    protected $primaryKey = 'community_ID';

    protected $fillable = ['us_ID', 'community_title', 'community_desc'];

    public function userID()
    {
        return $this->belongsTo(User::class, 'us_ID');
    }
    public function feedbacks()
    {
        return $this->hasMany(Feedbacks::class, 'community_ID');
    }
    public function likes()
    {
        return $this->hasMany(Likes::class, 'community_ID', 'community_ID');
    }
}
