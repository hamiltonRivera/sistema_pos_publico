<?php

namespace App\Livewire\Administrative\Incomes;

use Livewire\Component;
use App\Models\Gasto;
use App\Models\Sale;
class Incomes extends Component
{
    public  $fecha_efectivo, $fecha_transferencia, $cierre_efectivo,$cierre_transferencia;

    public $mostrarVenta = false, $mostrarVentaTotales = false, $fecha, $cierre, $gasto_dia, $fecha_gasto,
    $balance, $mostrarGasto = false, $mostrarBusquedaPersonalizada = false, $fecha_inicio, $fecha_fin, $custom_date;
    public function render()
    {
        return view('livewire.administrative.incomes.incomes');
    }

    public function mostrarVentas()
    {
       $this->mostrarVenta = true;
       $this->mostrarGasto = false;
       $this->mostrarBusquedaPersonalizada = false;

    }

    public function mostrarGastos()
    {
        $this->mostrarGasto = true;
        $this->mostrarVenta = false;
        $this->mostrarBusquedaPersonalizada = false;

    }

    public function customSearch()
    {
        $this->mostrarBusquedaPersonalizada = true;
        $this->mostrarGasto = false;
        $this->mostrarVenta = false;
    }

    public function clear()
    {
        $this->mostrarBusquedaPersonalizada = false;
        $this->mostrarGasto = false;
        $this->mostrarVenta = false;
    }

    public function cierreDelDia()
    {
      $ventas = Sale::whereFecha($this->fecha)->get();
      $ventaFormateada = $ventas->sum('totalPagado');
      $this->cierre = number_format($ventaFormateada, 2, '.', ',');
    }

    public function gastoDelDia()
    {
        $gastos = Gasto::whereFecha($this->fecha_gasto)->get();
        $this->gasto_dia = $gastos->sum('monto');
    }

    public function cierreEfectivo()
    {
        $ventasEfectivo = Sale::whereFecha($this->fecha_efectivo)->get();
        $formato = $ventasEfectivo->where('metodoPago', 'Efectivo')->sum('totalPagado');
        $this->cierre_efectivo = number_format($formato, 2, '.', ',');
    }

    public function cierreTransferencia()
    {
        $ventasTransferencia = Sale::whereFecha($this->fecha_transferencia)->get();
        $formato = $ventasTransferencia->where('metodoPago', 'Transferencia Bancaria')->sum('totalPagado');
        $this->cierre_transferencia = number_format($formato, 2, '.', ',');
    }

    public function customResearching()
   {
      $totalVentasCustom = Sale::whereBetween('fecha', [$this->fecha_inicio, $this->fecha_fin ])->sum('totalPagado');
      $totalVentasFormateado = number_format($totalVentasCustom, 2, '.', ',');
      $this->custom_date = $totalVentasFormateado;
   }


}
