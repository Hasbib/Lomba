<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $table = 'submissions';

    protected $fillable = [
        'sub_peserta_id',
        'sub_nama_lomba',
        'sub_judul',
        'sub_deskripsi',
        'sub_link',
        'sub_file',
    ];

    public function peserta()
    {
        return $this->belongsTo(User::class, 'sub_peserta_id', 'id');
    }
    public function lombasub()
    {
        return $this->belongsTo(Lomba::class, 'sub_nama_lomba', 'nama_lomba');
    }

}