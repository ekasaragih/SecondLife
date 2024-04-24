<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Communities extends Model
{
    use HasFactory;

    protected $table = 'communities';

    protected $fillable = [
        'us_ID',
        'community_title',
        'community_desc',
    ];

    public function userID()
    {
        return $this->belongsTo(User::class, 'us_ID');
    }
}