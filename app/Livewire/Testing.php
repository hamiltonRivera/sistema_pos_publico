<?php

namespace App\Livewire;

use Livewire\Component;

class Testing extends Component
{
    public $recibido, $total, $cambio;
    public function render()
    {
        return view('livewire.testing');
    }

    public function updated($field)
    {
        if ($field === 'total' || $field === 'recibido') {
            $this->cambio();
        }
    }
    public function cambio()
    {
        $this->cambio = $this->recibido - $this->total;
    }
}
