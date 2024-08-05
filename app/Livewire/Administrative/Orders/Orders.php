<?php

namespace App\Livewire\Administrative\Orders;

use Livewire\Component;
use App\Models\Gasto;
use App\Models\Product;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Order;
use App\Models\DetailOrder;
use App\Models\Provider;
use Livewire\WithPagination;
use App\Models\ActivityLog;
class Orders extends Component
{
    use WithPagination;
    public $search_product = '', $search_provider = '';

    public $metodoPagos =[
        'Efectivo',
        'Cheque',
        'Remesa',
        'Pago en línea',
        'Transferencia'
    ];

    public $detailProduct = [];
    public $productoSel;

      //datos de modelo pedidos
      public $provider_id, $fecha, $metodoPago, $totalPagado, $total;

      //datos de modelo producto
      public $product_id, $cantidad, $precio;



    public function render()
    {
        $providers = Provider::orderBy('id', 'asc')
         ->where('nombreApellido', 'like', '%' . $this->search_provider . '%')->get();

         $products = Product::orderBy('id', 'asc')
         ->whereAny(['descripcion', 'codigo'], 'like', '%' . $this->search_product . '%')->get();

        return view('livewire.administrative.orders.orders', compact('providers', 'products'));
    }

    public function refresh()
    {
        return redirect('/private/admin/orders');
    }


    public function buscarProducto(Product $id)

    {
        if (!empty($id)) {
            $this->productoSel = $id;
            $this->cantidad = 1;
            $this->precio = round($this->productoSel->precio_compra, 2);
        } else {
            // Reinicia los valores si no se selecciona ningún producto
            $this->resetearCamposTabla();
        }

        if ($this->cantidad <= 0 ) {
            session()->flash('cantidad', '*Error al digitar la cantidad.');
            $this->cantidad = 1;
        }

    }

    public function updatingProduct(Product $id)
      {
        $this->productoSel = Product::find($id);
        $this->cantidad = 1;
        $this->precio = round($this->productoSel->precio_compra, 2);
      }



    public function addItem($array)
    {   if(empty($this->productoSel))
        {
            session()->flash('productoSel', '*Tienes que seleccionar al menos un producto.');
        }else{
            $datos = [
                "id" => $this->productoSel->id,
                "descripcion" => $this->productoSel->descripcion,
                "precio_compra" => $this->productoSel->precio_compra,
                "cantidad" => $this->cantidad,
                "total" => round($this->cantidad * $this->productoSel->precio_compra, 2),
               ];
               $indexBuscar = array_search($this->productoSel->id, array_column($this->detailProduct, 'id'));

               //valida si se agrega 2 veces el mismo producto y si lo hace, se suman las cantidades y se deja 1
              if($indexBuscar !== false ) {
               $this->detailProduct[$indexBuscar]['cantidad'] = $this->detailProduct[$indexBuscar]['cantidad'] + $this->cantidad;
               $this->detailProduct[$indexBuscar]['total'] = round($this->detailProduct[$indexBuscar]['cantidad'] * $this->productoSel->precio_compra, 2);
          }else{
           array_push($this->detailProduct, $datos);
          }

          $this->resetearcamposTabla();
          $valorInicial = 0;

               //suma todos los subtotales
               $suma = array_reduce($this->detailProduct, function ($acc, $arr) {
                    return $acc + $arr['total'];
                }, $valorInicial);

            $this->total = $suma;
            $this->totalPagado = round($this->total, 2);
        }

    }

    public function resetearCamposTabla()
    {
        $this->productoSel = null;
        $this->cantidad = null;
        $this->precio = null;
        $this->product_id = null;
    }

    public function destroy($key)
    {
        array_splice($this->detailProduct, $key, 1);
        $valorInicial = 0;

        $suma = array_reduce($this->detailProduct, function ($acc, $arr) {
            return $acc + $arr['total'];
        }, $valorInicial);

        $this->total = $suma;
        $this->totalPagado = round($this->total, 2);
    }

    public function gastos()
    {
       $gastos = new Gasto();

       $gastos->descripcion = "Pedido a proveedor";
       $gastos->fecha = $this->fecha;
       $gastos->monto = $this->totalPagado;
       $gastos->tipo_gasto = 'Reinversión de negocio';
       $gastos->save();

    }

    public function store()
    {
        $this->validate([
            'provider_id' => 'required',
            'fecha' => 'required|date',
            'totalPagado' => 'required|numeric',
            'metodoPago' => 'required|string',

        ]);

        $neworder = New Order();
        $neworder->provider_id = $this->provider_id;
        $neworder->fecha = $this->fecha;
        $neworder->totalPagado = $this->totalPagado;
        $neworder->metodoPago = $this->metodoPago;
        $neworder->save();

        foreach($this->detailProduct as $producto)
        {
           $detOrden = New DetailOrder();
           $detOrden->order_id = $neworder->id;
           $detOrden->product_id = $producto['id'];
           $detOrden->precio = $producto['precio_compra'];
           $detOrden->cantidad = $producto['cantidad'];
           $detOrden->total = $producto['total'];
           $detOrden->save();

            $stock = Product::find($producto['id']);
            $stock->stock = $stock->stock + $producto['cantidad'];
            $stock->save();

            $newActivitie = new ActivityLog();
            $newActivitie->user_id = auth()->user()->id;
            $newActivitie->activity = "Nuevo registro";
            $newActivitie->detail = "Orden a proveedor";
            $newActivitie->save();

        }
        //asignando a gastos
        $this->gastos();
        Alert::success('Pedido', 'Pedido realizado exitosamente');
        $this->refresh();
    }

}
