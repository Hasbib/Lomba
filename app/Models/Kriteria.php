<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriterias';

    protected $fillable = [
        'id',
        'name',
        'bobot'
    ];

    public function lombas()
    {
        return $this->belongsToMany(Lomba::class, 'lomba_kriteria');
    }
}