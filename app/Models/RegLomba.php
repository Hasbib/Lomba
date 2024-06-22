<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegLomba extends Model
{
    use HasFactory;

    protected $table = 'reg_lombas';

    protected $fillable = [
        'reg_peserta_id',
        'reg_nama_tim',
        'reg_instansi',
        'reg_nama_lomba',
        'reg_no_whatsapp',
        'reg_email',
        'reg_bukti_pembayaran',
        'status',
        'message'
    ];

    public function peserta()
    {
        return $this->belongsTo(User::class, 'reg_peserta_id', 'id');
    }
    public function lomba()
    {
        return $this->belongsTo(Lomba::class, 'reg_nama_lomba', 'nama_lomba');
    }
    public function submission()
    {
        return $this->hasOne(Submission::class, 'sub_peserta_id', 'reg_peserta_id')
            ->where('sub_nama_lomba', $this->reg_nama_lomba);
    }
    public function teammember()
    {
        return $this->hasOne(TeamMember::class, 'team_peserta_id', 'reg_peserta_id')
            ->where('team_nama_lomba', $this->reg_nama_lomba);
    }
    public function scores()
    {
        return $this->hasMany(Score::class, 'reg_lomba_id');
    }
}