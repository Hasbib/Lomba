<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'nama_event',
        'judul',
        'sub_judul',
        'judul_deskripsi',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_berakhir',
        'logo_1',
        'logo_2',
        'logo_3'
    ];
}