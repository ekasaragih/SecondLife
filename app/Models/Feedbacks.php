<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedbacks extends Model
{
    use HasFactory;
    protected $table = 'feedback';

    protected $fillable = [
        'us_ID',
        'g_ID',
        'feedback_desc',
    ];

    public function userID()
    {
        return $this->belongsTo(User::class, 'us_ID');
    }

    public function communityID()
    {
        return $this->belongsTo(Communities::class, 'g_ID');
    }
}
