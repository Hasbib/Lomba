<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $table = 'scores';

    protected $fillable = [
        'reg_lomba_id',
        'juri_id',
        'kriteria_id',
        'nilai',
    ];

    public function regLomba()
    {
        return $this->belongsTo(RegLomba::class, 'reg_lomba_id');
    }

    public function juri()
    {
        return $this->belongsTo(User::class, 'juri_id');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }
}