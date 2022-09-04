<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acceso extends Model
{
    use HasFactory;
    protected $guarded = ['id','create_at'.'updated_at'];

    public function estancia()
    {
        return $this->hasOne(Estancia::class);
    }

    public function tipoVehiculo()
    {
        return $this->hasOne(TipoVehiculo::class);
    }

}
