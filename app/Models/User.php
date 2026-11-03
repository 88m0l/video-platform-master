<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin() 
    {
        return $this->user_type == 'admin';
    }

    public function isSuperAdmin() 
    {
        return $this->user_type == 'super_admin';
    }

    public function isBlocked() 
    {
        return $this->user_status == 'blocked';
    }

    public function isActive() 
    {
        return $this->user_status == 'active';
    }

    public function videos() {
        return $this->hasMany(Video::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

     public function notifications() {
        return $this->hasMany(Notification::class);
    }

    public function alert() {
        return $this->hasOne(Alert::class);
    }

    public function views() {
        return $this->hasMany(View::class);
    }

    public function videoInHistory() {
        return $this->belongsToMany(Video::class, 'video_user', 'user_id', 'video_id')->withTimestamps()->withPivot('id');
    }
}
