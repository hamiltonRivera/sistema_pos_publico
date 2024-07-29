<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cambio;
class Calculator extends Component
{

    public $fecha, $total, $cantidad;

    public function render()
    {
        $this->fecha = now()->format('Y-m-d');
        return view('livewire.calculator');
    }

    public function calcular()
    {
        $tasaDelDiaSeleccionado = Cambio::whereDate('fecha',$this->fecha)->first();
    //   $this->total = number_format($tasaDelDiaSeleccionado->valor, 5, '.', ',') * number_format($this->cantidad, 2, '.', ',');
        $this->total = number_format($tasaDelDiaSeleccionado->valor * $this->cantidad, 2, '.', ',');
    }
}
