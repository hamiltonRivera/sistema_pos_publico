<?php

namespace App\Livewire\Administrative\Settings;

use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Setting;
use App\Models\HistorialFactura;
use Livewire\WithPagination;
class Settings extends Component
{
    use WithPagination;
    public $search = '';

    public $nombre, $direccion, $ruc, $telefono, $email, $propietario, $consecutivo;
    public $selected_id, $validConsecutivo;
    public function render()
    {
        $settings = Setting::paginate(1);
        return view('livewire.administrative.settings.settings', compact('settings'));
    }

    public function refresh()
    {
        return redirect('/private/admin/setting');
    }

    public function edit($id)
    {
        $record = Setting::findOrFail($id);
        $this->selected_id = $id;
        $this->nombre = $record->nombre;
        $this->direccion = $record->direccion;
        $this->ruc = $record->ruc;
        $this->telefono = $record->telefono;
        $this->email = $record->email;
        $this->propietario = $record->propietario;
        $this->consecutivo = $record->consecutivo;
    }

    public function update()
    {
       $this->validate([
            'nombre' => 'required|string',
            'direccion' => 'required|string',
            'ruc' => 'required|string',
            'telefono' => 'required|numeric',
            'email' => 'nullable|email',
            'propietario' => 'required|string',
            'consecutivo' => 'required|numeric',
        ]);

        //condicion de validar consecutivo ya usado
        $this->validConsecutivo = HistorialFactura::where('numFactura', $this->consecutivo)->count();
        if ($this->validConsecutivo) {
            session()->flash('message', 'El consecutivo ya está en uso.');

            return false;
        } else {
            if ($this->selected_id) {
                $record = Setting::findOrFail($this->selected_id);
                $record->update([
                    'nombre' => $this->nombre,
                    'direccion' => $this->direccion,
                    'ruc' => $this->ruc,
                    'telefono' => $this->telefono,
                    'email' => $this->email,
                    'propietario' => $this->propietario,
                    'consecutivo' => $this->consecutivo
                ]);

                Alert::success('Datos del negocio', 'Datos actualizados correctamente');
                $this->refresh();
            }
        }
    }


}
