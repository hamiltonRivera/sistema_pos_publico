<?php

namespace App\Livewire\DailyProcess\Gastos;

use Livewire\Component;
use App\Models\ActivityLog;
use RealRashid\SweetAlert\Facades\Alert;
use Livewire\WithPagination;
use App\Models\Gasto;
class Gastos extends Component
{
    use WithPagination;
    public $search = '';
    public $descripcion, $fecha, $monto, $tipo_gasto, $selected_id;

    public $tipo_gastos = [
        'Reinversión de negocio',
        'Operacionales',
       'Administrativos',
       'Gastos Fijos',
       'Discrecionales',
       'Gastos Variables',
       'Gastos de emergencia',
       'Personales',
       'Financieros',
       'Comerciales',
       'Impuestos',
       'Otros Gastos'
    ];

    public function render()
    {
        $outcomes = Gasto::orderBy('id', 'asc')
        ->whereAny(['descripcion', 'fecha', 'tipo_gasto'], 'like', '%' . $this->search . '%')->paginate(10);
        return view('livewire.daily-process.gastos.gastos', compact('outcomes'));
    }

    public function refresh()
    {
        return redirect('/private/outcomes');
    }

    public function store()
    {
        $this->validate([
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'monto' => 'required|numeric',
            'tipo_gasto' => 'required|string|max:23'
        ]);

        $gasto = new Gasto();
        $gasto->descripcion = ucfirst(strtolower($this->descripcion));
        $gasto->fecha = $this->fecha;
        $gasto->monto = round($this->monto, 2);
        $gasto->tipo_gasto = ucfirst(strtolower($this->tipo_gasto));
        $gasto->save();

        $newActivitie = new ActivityLog();
        $newActivitie->user_id = auth()->user()->id;
        $newActivitie->activity = "Nuevo Registro - Gasto";
        $newActivitie->detail = $this->descripcion;
        $newActivitie->save();
        Alert::success('Gasto', 'Gasto registrado exitosamente');
        $this->refresh();
    }

    public function edit($id)
    {
        $record = Gasto::findOrFail($id);
        $this->selected_id = $id;
        $this->descripcion = $record->descripcion;
        $this->fecha = $record->fecha;
        $this->monto = $record->monto;
        $this->tipo_gasto = $record->tipo_gasto;

    }

    public function update()
    {
        $this->validate([
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'monto' => 'required|numeric',
            'tipo_gasto' => 'required|string|max:23'
        ]);

        if($this->selected_id)
        {
            $record = Gasto::findOrFail($this->selected_id);
            $record->update([
                'descripcion' => ucfirst(strtolower($this->descripcion)),
                'fecha' => $this->fecha,
                'monto' => round($this->monto, 2),
                'tipo_gasto' => ucfirst(strtolower($this->tipo_gasto))
            ]);
            $newActivitie = new ActivityLog();
            $newActivitie->user_id = auth()->user()->id;
            $newActivitie->activity = "Registro Actualizado - Gasto";
            $newActivitie->detail = $record->descripcion;
            $newActivitie->save();
            Alert::success('Gasto', 'Gasto actualizado exitosamente');
            $this->refresh();
        }
    }

    public function destroy($id)
    {
        $record = Gasto::findOrFail($id);
        Gasto::destroy($id);

        $newActivitie = new ActivityLog();
        $newActivitie->user_id = auth()->user()->id;
        $newActivitie->activity = "Registro Eliminado - producto";
        $newActivitie->detail = $record->descripcion;
        $newActivitie->save();
        Alert('Gasto', 'Has eliminado el registro');
        $this->refresh();
    }
}
