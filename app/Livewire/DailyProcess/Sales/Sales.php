<?php

namespace App\Livewire\DailyProcess\Sales;

use Livewire\Component;
use App\Models\Product;
use App\Models\Client;
use App\Models\Sale;
use App\Models\DetailSale;
use App\Models\Cambio;
use App\Models\Setting;
use App\Models\User;
use App\Models\HistorialFactura;
use App\Models\ActivityLog;
use RealRashid\SweetAlert\Facades\Alert;
use Livewire\WithPagination;

class Sales extends Component
{
    use WithPagination;
    public $search_product = '', $search_client = '';

    public $sale_id, $product_id, $precio, $cantidad, $total, $producto;
    public $productSel;
    public $detailProduct = [];

    //porcentaje de descuentos
    public $descuentos = [
        5,
        10,
        15,
        20,
        25,
        30,
        35,
        40,
        45,
        50
    ];

    public $metodos = [
        'Efectivo',
        'Transferencia Bancaria'
    ];


    public $descuento_i, $ver_descuento_individual = false, $descuento_individual, $precio_descuento, $monto_descontado_individual;


    //mostrar y ocultar total cuando hay descuento
    public $descuentoSel = false, $ocultarTotal = true;

    public $client_id, $fecha, $numFactura, $descuento, $totalPagado, $fechaVencimiento,
        $cambio, $totalRecibido, $totalDescuento, $totalPagadoDescuento, $user_id, $metodoPago, $exchangeRate;

    public function updatedCantidad()
    {
        $this->precio = 0;
        if ($this->productSel) {
            if ($this->cantidad >= 3) {
                $this->precio = $this->productSel->precio_venta_mayor;
            } else {
                $this->precio = $this->productSel->precio_venta_unidad;
            }
        }
    }

    public function mount()
    {
        // Obtener el registro de cambio para la fecha actual
        $cambio = Cambio::where('fecha', today())->first();

         // Verificar si se encontró un registro para la fecha actual
         if ($cambio) {
            $this->exchangeRate = $cambio->valor;
        } else {
            $this->exchangeRate = "Sin registro";
        }
    }
    public function render()
    {
        $clients = Client::orderBy('id', 'asc')
         ->whereAny(['nombreApellido', 'telefono'], 'like', '%' . $this->search_client . '%')->get();

        $products = Product::orderBy('id', 'asc')
        ->whereAny(['descripcion', 'codigo'], 'like', '%' . $this->search_product . '%')->get();

        //algoritmo para recuperar la ultima factura disponible y le suma 1
        $facturaDisponible = Setting::pluck('consecutivo');
        $this->numFactura = $facturaDisponible->implode(',') + 1;

        $this->fecha = now()->format('Y-m-d');
        return view('livewire.daily-process.sales.sales', compact('clients', 'products', 'facturaDisponible'));
    }

    public function refresh()
    {
        return redirect('/private/sales');
    }

    public function mostrarDescuento()
    {
        $this->descuentoSel = true;
        $this->ocultarTotal();

        $this->totalDescuento = round((($this->totalPagado * $this->descuento) / 100), 2);

        $this->totalPagadoDescuento = round($this->totalPagado - $this->totalDescuento, 2);
        $this->totalPagado = $this->totalPagadoDescuento;
    }

    public function mostarDescuentoIndividual()
    {
        if ($this->productSel) {
            if ($this->descuento_individual == "Si") {
                $this->ver_descuento_individual = true;
                $this->monto_descontado_individual = ($this->precio * $this->descuento_i) / 100;
                $this->precio_descuento = round($this->precio - $this->monto_descontado_individual, 2);
            }
        } else {
            $this->descuento_individual = null;
        }
    }

    //oculta el total sin descuento
    public function ocultarTotal()
    {
        $this->ocultarTotal = false;
    }

    public function buscarProducto()
    {
        $this->precio_descuento = $this->precio;
        $this->productSel = Product::whereAny(['codigo', 'descripcion'], 'like', '%' . $this->search_product . '%')->first();

        if ($this->productSel) {
            $this->cantidad = 1;
            $this->precio = floatval($this->productSel->precio_venta_unidad);
        } else {
            session()->flash('producto', '*El producto digitado no existe o es incorrecto.');
        }
    }

    public function limpiarBusqueda()
    {
        $this->search_product = null;
        $this->precio = null;
        $this->cantidad = null;
        $this->product_id = null;
        $this->productSel = null;
        $this->ver_descuento_individual = false;
        $this->descuento_individual = null;
        $this->precio_descuento = null;
        $this->descuento_i = null;
    }

    public function historial()
    {
        $historial = new HistorialFactura();
        //condicional que si el total a pagar es con descuento o no
        if ($this->descuento) {
            $historial->monto = $this->totalPagadoDescuento;
        } else {
            $historial->monto = $this->totalPagado;
        }
        $historial->numFactura = $this->numFactura;
        $historial->fecha = $this->fecha;

        $historial->descripcion = "Nuevo Registro - Venta Realizada";
        $historial->client_id = $this->client_id;
        $historial->user_id = auth()->user()->id;
        $historial->metodoPago = $this->metodoPago;
        $historial->save();
    }


    public function resetearcamposTabla()
    {
        $this->productSel = null;
        $this->cantidad = null;
        $this->precio = null;
        $this->product_id = null;
        $this->search_product = null;
        $this->ver_descuento_individual = false;
        $this->descuento_individual = null;
        $this->precio_descuento = null;
        $this->descuento_i = null;
    }

    public function calcular()
    {
         //verifica si la cantidad es 0, si lo es le asigna 1
        if (!$this->cantidad) $this->cantidad = 1;

        //validacion que la cantidad digitada no sea mayor al producto en stock
        if ($this->cantidad > $this->productSel->stock) {
            session()->flash('cantidad', '*La cantidad digitada no puede ser mayor al stock.');
            $this->cantidad = 1;
            return $this->totalPagado = 0;
        }

        //valida que la cantidad no sea negativo
        if ($this->cantidad < 1) {
            session()->flash('cantidad', '*La cantidad digitada no puede ser menor a 1.');
            $this->cantidad = 1;
            return $this->totalPagado = 0;
        }

        //valida que si la cantidad del producto a llevar es igual o mayor a 3 que se aplique el precio por mayor
        $this->cantidad >= 3 ? $this->precio = floatval($this->productSel->precio_venta_mayor) :  $this->precio = floatval($this->productSel->precio_venta_unidad);
    }

    public function comprobarPago()
    {
        //Valida que el total recibido es menor a total a pagar
        if ($this->totalRecibido < $this->totalPagado) {
            session()->flash('message', '*El total recibido no puede ser menor al total a pagar.');
            $this->totalRecibido = $this->totalPagado;
            $this->cambio = 0;
            return false;
        }
    }

    public function comprobarPagoDescuento()
    {
        if ($this->totalRecibido < $this->totalPagadoDescuento) {
            session()->flash('message', '*El total recibido no puede ser menor al total a pagar.');
            $this->totalRecibido = $this->totalPagadoDescuento;
            $this->cambio = 0;
            return false;
        }
    }

    public function pagoTransferencia()
    {
        if ($this->metodoPago == "Transferencia Bancaria") {
            $this->totalRecibido = $this->totalPagado;
            $this->cambio = 0;
        }
    }
     
    //esta funcion hace que calcule el cambio 
    //la tuve que agregar porque en livewire 2 no la necesitaba, en livewire 3 si 
    public function updated($field)
    {
        if($field === 'totalRecibido' || $field === 'totalPagadoDescuento' || $field === 'totalPagado')
        {
            $this->cambio();
        }
    }

    public function cambio()
    {
        //verifica si el cambio a dar es resultado de un descuento
        if ($this->descuento) {
            $this->cambio = round($this->totalRecibido - $this->totalPagadoDescuento, 2);
            $this->comprobarPagoDescuento();
        } else {
            $this->cambio = round($this->totalRecibido - $this->totalPagado, 2);
            $this->comprobarPago();
        }
    }

    //radio button que valida si se va a aplicar descuento individual
    public function getPrecio()
    {
        return $this->descuento_individual == "Si" ? $this->precio_descuento : $this->precio;
    }

    //funcion para agregar el producto al carrito
    public function addItem($array)
    {   
        if($this->productSel == null)
        {
            session()->flash('addItem', '*Campos Vacíos. Agrega un producto primero.');
            return false;
        }
        //valida que si el producto seleccionado se encuera sin stock, lo quita de la cesta
        if ($this->productSel->stock == 0) {
            return false;
        }

        //se recuperan los datos del producto en array para pasarlos en la tabla
        $datos = [
            "id" => $this->productSel->id,
            "descripcion" => $this->productSel->descripcion,
            "precio_venta" => $this->getPrecio(),
            "cantidad" => $this->cantidad,
            "total" => round($this->getPrecio() * $this->cantidad, 2),
        ];
        $indexBuscar = array_search($this->productSel->id, array_column($this->detailProduct, 'id'));

        //valida si se agrega 2 veces el mismo producto y si lo hace, se suman las cantidades y se deja 1
        if ($indexBuscar !== false) {
            $this->detailProduct[$indexBuscar]['cantidad'] = $this->detailProduct[$indexBuscar]['cantidad'] + $this->cantidad;
            $this->detailProduct[$indexBuscar]['total'] = round($this->detailProduct[$indexBuscar]['cantidad'] * $this->getPrecio(), 2);
        } else {
            array_push($this->detailProduct, $datos);
        }
        //una vez que añade el producto a la cesta resetea los campos y se ubica en el input deal buscador

        $this->resetearcamposTabla();
        $valorInicial = 0;

        //suma todos los subtotales
        $suma = array_reduce($this->detailProduct, function ($acc, $arr) {
            return $acc + $arr['total'];
        }, $valorInicial);

        $this->total = $suma;
        $this->totalPagado = round($this->total, 2);
    }

    //funcion para eliminar el producto de la cesta
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

    public function store()
    {

        $this->validate([
            'numFactura' => 'required|numeric|unique:sales,numFactura',
            'fecha' => 'required|date',
            'client_id' => 'required',
            'descuento' => 'nullable|numeric',
            'totalPagado' => 'required|numeric',
            'cambio' => 'required|numeric',
            'totalRecibido' => 'required|numeric',
            'totalDescuento' => 'nullable|numeric',
            'totalPagadoDescuento' => 'nullable|numeric',
            'metodoPago' => 'required|string'

        ]);
        $newventa = new Sale();
        $newventa->client_id = $this->client_id;
        $newventa->descuento = $this->descuento;
        $newventa->numFactura = $this->numFactura;
        $newventa->fecha = $this->fecha;
        $newventa->totalPagado = $this->totalPagado;
        $newventa->cambio = $this->cambio;
        $newventa->totalRecibido = $this->totalRecibido;
        $newventa->totalDescuento = $this->totalDescuento;
        $newventa->totalPagadoDescuento = $this->totalPagadoDescuento;
        $newventa->user_id = auth()->user()->id;
        $newventa->metodoPago = $this->metodoPago;
        $newventa->save();

        //historial de factura
        $this->historial();

        //añade el numero de factura y lo suma
        $setting = Setting::first();
        $setting->consecutivo = $this->numFactura;
        $setting->save();

        //itera los productos añadidos a la cesta
        foreach ($this->detailProduct as $product) {
            $detaProduc = new DetailSale();
            $detaProduc->product_id = $product['id'];
            $detaProduc->sale_id = $newventa->id;
            $detaProduc->precio = $product['precio_venta'];
            $detaProduc->cantidad = $product['cantidad'];
            $detaProduc->total = $product['total'];
            $detaProduc->save();

            //elimina del inventario las cantidades del producto facturado
            $stock = Product::find($product['id']);
            $stock->stock = $stock->stock - $product['cantidad'];
            $stock->save();

            $newActivity = new ActivityLog();
            $newActivity->user_id = auth()->user()->id;
            $newActivity->activity = "Nuevo Registro - Venta Realizada";
            $newActivity->detail = "No Factura: " . $newventa->numFactura;
            $newActivity->save();
        }
         //algoritmo para imprimir voucher **importante*** solo para windows

        //$impresora = "//localhost/POS-58";
        //$connector = new FilePrintConnector($impresora);
        //$printer = new Printer($connector);
        //$img = EscposImage::load("main.jpg");
        //datos del negocio
        //justificado al centro
        //$printer->setjustification(Printer::JUSTIFY_CENTER);
        //$printer->text("Eli Makeup Store\n\n");
        //$printer->graphics($img);
        //$printer->text("Dirección: Matagalpa, de gasolinera gas central 90mtrs al oeste, contigo a restaurante el" . "\n");
        //$printer->text("taquero" . "\n");
        //$printer->text("Teléfono: 8841-6715 / 8703-2918" . "\n");
        //$printer->text("===============================\n");

        //justificar a la derecha
        //$printer->setjustification(Printer::JUSTIFY_LEFT);
        //$printer->text("Fecha: " . Carbon::parse($newventa->created_at) . "\n");
        //$printer->text("No de factura: " . $newventa->numFactura . "\n");
        //$printer->text("===============================\n");

        //justificado a la izquierda
        //$printer->setjustification(Printer::JUSTIFY_LEFT);
        //$printer->text("Cliente: ". $newventa->client->nombreApellido . "\n\n");

        //justificado al centro
        //$printer->setjustification(Printer::JUSTIFY_CENTER);
        //$printer->text("==================\n");
        //$printer->text("Detalle de la venta\n");
        //$printer->text("==================\n");

        //justificado a la izquierda
        //$printer->setjustification(Printer::JUSTIFY_LEFT);
        //$fonts = array(Printer::FONT_A, Printer::FONT_B, Printer::FONT_C);
        //$printer->text("Producto|" . "Precio|" . "Cantidad|" . "Total" . "\n");
        //$printer->text("------------------------------"  . "\n");
        //foreach($this->detailProduct as $product){
        //$printer->setFont($fonts[2]);
        //$printer->text("* " . $product['descripcion'] . " |" . $product['precio_venta'] . "|" . " * " . $product['cantidad'] . " = " .  $product['total'] . "\n" );

        //}
        //$printer->text("=======================\n");
        //$printer->text("Total: " . $newventa->totalPagado . "\n");
        //$printer->text("Cambio: " . $newventa->cambio . "\n");
        //$printer->text("Atendido por: " . $newventa->user->name . "\n\n\n\n");
        //$printer->text('Nota: revise su árticulo, no se aceptan devoluciones');
        //$printer ->cut();
        //$printer ->close();

        Alert::success('Venta', 'Venta realizada exitosamente');
        $this->refresh();
    }

}
