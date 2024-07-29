<?php

namespace App\Livewire\Administrative\VouchersHistory;

use Livewire\Component;
use App\Models\HistorialFactura;
use Livewire\WithPagination;
class VouchersHistory extends Component
{
    use WithPagination;
    public $search = '';
    public $cantidad_seleccionada, $monto_del_dia = 0, $fecha_del_dia;

    public $entradas = [
        5,
        10,
        15,
        20,
        30
    ];
    public function render()
    {
        $busqueda = '%' . $this->search . '%';
        $histories = HistorialFactura::with('user', 'client')
         ->whereRelation('user', 'name', 'like', '%' . $busqueda . '%')
         ->orWhereRelation('client', 'nombreApellido', 'like', '%' . $busqueda . '%')
         ->orWhereAny(['numFactura', 'fecha', 'descripcion', 'metodoPago'])->paginate(10);

         //recupera la fecha que digite y sum el total de todo el dia
         $this->fecha_del_dia = HistorialFactura::whereFecha($this->search)->get();
         $this->monto_del_dia = $this->fecha_del_dia->sum('monto');
        return view('livewire.administrative.vouchers-history.vouchers-history', compact('histories'));
    }

    public function limpiarBusqueda()
    {
        $this->search = null;
        $this->monto_del_dia = 0;
    }
}
