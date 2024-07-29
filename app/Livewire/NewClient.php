<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;
use App\Models\ActivityLog;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
class NewClient extends Component
{
    public $nombreApellido, $ciudad, $direccion, $telefono;
    public function render()
    {
        return view('livewire.new-client');
    }

    public function refresh()
    {
        return redirect('/private/sales');
    }


    public function store()
    {
        $this->validate([
            'nombreApellido' => 'required|string',
            'ciudad' => 'required|string',
            'direccion' => 'required|string',
            'telefono' => 'required|string|unique:clients,telefono,'
        ]);

        $newClient = new Client();
        $newClient->nombreApellido = ucwords(strtolower($this->nombreApellido));
        $newClient->ciudad = ucwords(strtolower($this->ciudad));
        $newClient->direccion = ucwords(strtolower($this->direccion));
        $newClient->telefono = $this->telefono;

        $newClient->save();
        Alert::success('Cliente', 'Cliente registrado exitosamente');
        $this->refresh();
    }

    public function addGuiones()
    {
        if(Str::length($this->telefono) == 4)
        {
            $this->telefono = $this->telefono . '-';
        }
    }
}
