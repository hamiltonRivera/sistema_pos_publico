<?php

namespace App\Livewire\Administrative\Providers;

use Livewire\Component;
use App\Models\ActivityLog;
use RealRashid\SweetAlert\Facades\Alert;
use Livewire\WithPagination;
use App\Models\Provider;
class Providers extends Component
{
    use WithPagination;
    public $search = '';

    public $selected_id, $nombreApellido, $ciudad, $empresa,$telefono;
    public function render()
    {
        $providers = Provider::orderBy('id', 'asc')
        ->where('nombreApellido', 'like', '%' . $this->search . '%')
        ->orWhere('telefono', 'like', '%' . $this->search . '%')->paginate(5);
        return view('livewire.administrative.providers.providers', compact('providers'));
    }

    public function refresh()
    {
        return redirect('/private/admin/providers');
    }

    public function store()
    {
       $this->validate([
        'nombreApellido' => 'string|required',
        'telefono' => 'required|string|max:9',
        'ciudad' => 'required|string',
        'empresa' => 'required|string'
       ]);

       $newProvider = new Provider();
       $newProvider->nombreApellido = ucfirst(strtolower($this->nombreApellido));
       $newProvider->telefono = $this->telefono;
       $newProvider->ciudad = ucfirst(strtolower($this->ciudad));
       $newProvider->empresa = ucfirst(strtolower($this->empresa));
       $newProvider->save();

       //activity log
       $newActivitie = new ActivityLog();
        $newActivitie->user_id = auth()->user()->id;
        $newActivitie->activity = "Nuevo Registro - Proveedor";
        $newActivitie->detail = $this->nombreApellido;
        $newActivitie->save();
       Alert::success('Proveedor', 'Proveedor registrado exitosamente');
       $this->refresh();

    }

    public function edit($id)
    {
       $record = Provider::findOrFail($id);
       $this->selected_id = $id;
       $this->nombreApellido = $record->nombreApellido;
       $this->telefono = $record->telefono;
       $this->empresa = $record->empresa;
       $this->ciudad = $record->ciudad;
    }

    public function update()
    {
        $this->validate([
            'nombreApellido' => 'string|required',
            'telefono' => 'required|string|max:9',
            'ciudad' => 'required|string',
            'empresa' => 'required|string'
           ]);

           if($this->selected_id){
             $record = Provider::findOrFail($this->selected_id);
             $record->update([
              'nombreApellido' => ucfirst(strtolower($this->nombreApellido)),
              'telefono' => $this->telefono,
              'ciudad' => ucfirst(strtolower($this->ciudad)),
              'empresa'=> ucfirst(strtolower($this->empresa))
             ]);

             $newActivitie = new ActivityLog();
            $newActivitie->user_id = auth()->user()->id;
            $newActivitie->activity = "Registro Modificado - Proveedor";
            $newActivitie->detail = $record->nombreApellido;
            $newActivitie->save();
            Alert::success('Proveedor', 'Proveedor actualizado exitosamente');
            $this->refresh();

           }
    }

    public function destroy($id)
    {
       $record = Provider::findOrFail($id);

        $activity = new ActivityLog();
        $activity->user_id = auth()->user()->id;
        $activity->activity = "Registro Eliminado - Proveedor";
        $activity->detail = $record->nombreApellido;
        $activity->save();

       Provider::destroy($id);
       Alert::warning('Categoría', 'Has eliminado el registro!');
       $this->refresh();
    }

    public function updatedtelefono()
    {
        // Remove any non-digit characters from the phone number
        $cleanedNumber = preg_replace('/[^0-9]/', '', $this->telefono);

        // Check if the cleaned number has at least 4 digits
        if (strlen($cleanedNumber) >= 4) {
            // Insert a hyphen after the fourth digit
            $formattedNumber = substr($cleanedNumber, 0, 4) . '-' . substr($cleanedNumber, 4);
            $this->telefono = $formattedNumber;
        }
    }
}
