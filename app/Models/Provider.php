<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    public $timestamp = true;

    protected $fillable = [
        'nombreApellido',
        'ciudad',
        'empresa',
        'telefono'];

        public function orders()
        {
             return $this->hasMany(Order::class);
        }
}
