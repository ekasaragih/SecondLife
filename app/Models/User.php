<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'us_ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'us_ID', 
        'us_name',
        'us_username',
        'role_id',
        'us_gender',
        'us_DOB',
        'us_email',
        'email_verified_at',
        'password',
        'avatar',
        'password_updated_at',
        'us_stat',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function userRole()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function goods()
    {   
        return $this->hasMany(Goods::class, 'us_ID', 'us_ID');
    }

    public function following(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follow', 'follower_id', 'followed_id')->withTimestamps();
    }

    public function isFollowing(User $user): bool
    {
        return $this->following()->where('followed_id', $user->getKey())->exists();
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follow', 'followed_id', 'follower_id')->withTimestamps();
    }
    
    public function unreadMessages()
    {
        return Message::where('receiver_id', $this->us_ID)
                      ->where('is_read', false)
                      ->get();
    }
}
