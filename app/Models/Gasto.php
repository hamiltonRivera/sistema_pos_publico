<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    use HasFactory;
    public $timestamp = true;
    protected $fillable = [
        'descripcion',
        'fecha',
        'monto',
        'tipo_gasto'
    ];
}
