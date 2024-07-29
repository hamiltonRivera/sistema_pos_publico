<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'stock',
        'fecha_vencimiento',
        'precio_compra',
        'precio_venta_unidad',
        'precio_venta_mayor',
        'category_id',
        'codigo'
    ];

    public $timestamp = true;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function detailSale()
    {
        return $this->hasMany(DetailSale::class);
    }

    public function detailOrder()
    {
        return $this->hasMany(DetailOrder::class);
    }
}
