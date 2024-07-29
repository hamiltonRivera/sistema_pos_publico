<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialFactura extends Model
{
    use HasFactory;

    protected $fillable =[
        'numFactura',
        'fecha',
        'monto',
        'descripcion',
        'client_id',
        'user_id',
        'metodoPago'
    ];

    public $timestamp = true;

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
