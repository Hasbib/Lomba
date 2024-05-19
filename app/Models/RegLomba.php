<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegLomba extends Model
{
    use HasFactory;

    protected $table = 'reg_lombas';

    protected $fillable = [
        'reg_nama_tim',
        'reg_instansi',
        'reg_nama_lomba',
        'reg_no_whatsapp',
        'reg_email',
        'reg_bukti_pembayaran',
        'reg_peserta_id'
    ];

    public function lomba()
    {
        return $this->belongsTo(Lomba::class, 'reg_nama_lomba', 'nama_lomba');
    }
    public function peserta()
    {
        return $this->belongsTo(User::class, 'reg_peserta_id', 'id');
    }
}