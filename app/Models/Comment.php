<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'comment_ID';

    protected $fillable = [
        'us_ID', 
        'comment_desc',  
        'g_ID'
    ];

    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class, 'us_ID');
    }

    // Relationship with Good model
    public function goods()
    {
        return $this->belongsTo(Goods::class, 'g_ID');
    }

    // Method to retrieve all comments
    public static function getAllComments()
    {
        return self::all();
    }
}
