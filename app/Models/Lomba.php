<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lomba extends Model
{
    use HasFactory;

    protected $table = 'lombas';
    protected $fillable = [
        'id',
        'nama_lomba',
        'deskripsi',
        'nama_pj',
        'kontak_pj',
        'tempat',
        'biaya_pendaftaran',
        'gambar',
        'sertifikat'
    ];

    public function kriterias()
    {
        return $this->belongsToMany(Kriteria::class, 'lomba_kriteria');
    }

    public function regLombas()
    {
        return $this->hasMany(RegLomba::class, 'reg_nama_lomba', 'nama_lomba');
    }
    public function userlomba()
    {
        return $this->belongsToMany(User::class, 'juri_lomba');
    }
}