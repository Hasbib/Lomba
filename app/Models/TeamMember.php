<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $table = 'team_members';

    protected $fillable = [
        'team_peserta_id',
        'team_nama_lomba',
        'team_member_name',
        'team_member_nik',
        'team_member_instansi',
        'team_member_role',
        'team_member_picture',
        'status',
    ];

    public function peserta()
    {
        return $this->belongsTo(User::class, 'team_peserta_id', 'id');
    }
    public function lomba()
    {
        return $this->belongsTo(Lomba::class, 'team_nama_lomba', 'nama_lomba');
    }
}