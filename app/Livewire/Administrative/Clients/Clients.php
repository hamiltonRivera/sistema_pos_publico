<?php

namespace App\Livewire\Administrative\Clients;

use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;
use Livewire\WithPagination;
use App\Models\Client;
use App\Models\ActivityLog;
use Illuminate\Support\Str;
class Clients extends Component
{

    use WithPagination;
    public $search = '';

    public $nombreApellido, $ciudad, $direccion, $telefono, $selected_id;
    public function render()
    {
        $clients = Client::orderBy('id', 'asc')
        ->where('nombreApellido', 'like', '%' .$this->search . '%')
        ->orWhere('telefono', 'like', '%' . $this->search . '%')->paginate(10);
        return view('livewire.administrative.clients.clients', compact('clients'));
    }

    public function refresh()
    {
        return redirect('/private/admin/client');
    }

    public function store()
    {

        $validation = $this->validate([
            'nombreApellido' => 'required|string',
            'ciudad' => 'required|string',
            'direccion' => 'required|string',
             'telefono' => 'required|string|unique:clients,telefono',
        ]);
        Client::create($validation);

        $newActivity = new ActivityLog();
        $newActivity->user_id = auth()->user()->id;
        $newActivity->activity = "Nuevo Registro - cliente";
        $newActivity->detail = $this->nombreApellido;
        $newActivity->save();

        Alert::success('Cliente', 'Cliente registrado exitosamente');
        $this->refresh();
    }

    public function edit($id)
    {
        $record = Client::findOrFail($id);
        $this->selected_id = $id;
        $this->nombreApellido = $record->nombreApellido;
        $this->ciudad = $record->ciudad;
        $this->direccion = $record->direccion;
        $this->telefono = $record->telefono;
    }

    public function update()
    {
        $this->validate([
            'nombreApellido' => 'required|string',
            'ciudad' => 'required|string',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
        ]);

        if ($this->selected_id) {
            $record = Client::findorFail($this->selected_id);
            $record->update([
                'nombreApellido' => ucwords(strtolower($this->nombreApellido)),
                'ciudad' => ucwords(strtolower($this->ciudad)),
                'direccion' => ucwords(strtolower($this->direccion)),
                'telefono' => $this->telefono
            ]);

            $newActivitie = new ActivityLog();
            $newActivitie->user_id = auth()->user()->id;
            $newActivitie->activity = "Registro Modificado - cliente";
            $newActivitie->detail = $record->nombreApellido;
            $newActivitie->save();

            Alert::success('Cliente', 'Cliente actualizado exitosamente');
            $this->refresh();
        }
    }

    public function destroy($id)
    {
        $record = Client::findOrFail($id);
        $this->selected_id = $id;

        $activity = new ActivityLog();
        $activity->user_id = auth()->user()->id;
        $activity->activity = "Registro Eliminado - cliente";
        $activity->detail = $record->nombreApellido;
        $activity->save();

        Client::destroy($id);
        Alert::warning('Cliente', 'Has eliminado el registro');
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
