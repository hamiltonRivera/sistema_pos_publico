<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'provider_id',
        'fecha',
        'totalPagado',
        'metodoPago',
    ];

    public $timestamp = true;

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function detailOrders()
    {
        return $this->hasMany(DetailOrder::class);
    }
}
