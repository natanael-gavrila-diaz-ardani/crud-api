<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'usia',
        'email',
        'deskripsi',
        'tanggal_lahir',
        'gender',
        'status',
    ];

    public function hobis()
    {
        return $this->belongsToMany(Hobi::class, 'anggota_hobi');
    }
}
