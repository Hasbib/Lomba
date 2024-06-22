<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'instansi',
        'kontak',
        'nik',
        'images',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getStatusAttribute()
    {
        return $this->email_verified_at ? 'Verified' : 'Unverified';
    }

    public function teamMembers()
    {
        return $this->hasMany(TeamMember::class, 'team_peserta_id')
            ->where('team_member_role', '<>', 'ketua');
    }

    public function userlomba()
    {
        return $this->belongsToMany(Lomba::class, 'juri_lomba');
    }
    public function scores()
    {
        return $this->hasMany(Score::class, 'juri_id');
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}