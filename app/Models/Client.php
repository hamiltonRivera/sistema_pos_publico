<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    public $timestamp = true;

    protected $fillable = [
        'nombreApellido',
        'ciudad',
        'direccion',
        'telefono'
    ];

    public function historial()
    {
        return $this->hasMany(HistorialFactura::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
