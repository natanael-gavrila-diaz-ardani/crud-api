<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hobi extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];

    public function anggotas()
    {
        return $this->belongsToMany(Anggota::class, 'anggota_hobi');
    }
}
