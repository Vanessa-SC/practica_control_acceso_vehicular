<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estancia extends Model
{
    use HasFactory;
    protected $fillable = ['hora_entrada', 'hora_salida'];

    public function acceso() 
    {
        return $this->belongsTo(Acceso::class);
    }
}
