<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'fecha',
        'numFactura',
        'descuento',
        'totalPagado',
        'cambio',
        'totalRecibido',
        'totalDescuento',
        'totalPagadoDescuento',
        'user_id',
        'metodoPago'
    ];

    public function detailSales()
    {
      return $this->hasMany(DetailSale::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
