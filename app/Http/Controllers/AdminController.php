<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Sale;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
use Carbon\Carbon;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\ImagickEscposImage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Exports\CategoryExport;
use Maatwebsite\Excel\Facades\Excel;
class AdminController extends Controller
{

    public function userscontrol()
    {
       return view('administrative.admin.users.users-control');
    }

    public function createAdminUser()
    {
       return view('administrative.admin.users.adminUser');
    }

    public function createCashierUser()
    {
       return view('administrative.admin.users.cashierUser');
    }

    public function categories()
    {
        return view('administrative.admin.category');
    }

    public function providers()
    {
      return view('administrative.admin.providers');
    }

    public function orders()
    {
        return view('administrative.admin.orders-providers');
    }

    public function activity_log()
    {
        return view('administrative.admin.activity-log');
    }

    public function ordersDone()
    {
        return view('administrative.admin.ordersDone');
    }

    public function detailOrders(Order $id)
    {
        $items = $id->detailOrders()->paginate(15);
        return view('administrative.admin.detailOrders', compact('id', 'items'));
    }

    public function setting()
    {
        return view('administrative.admin.setting');
    }

    public function client()
    {
        return view('administrative.admin.clients');
    }

    public function sessonHistory()
    {
        return view('administrative.admin.sessonHistory');
    }

    public function salesDone()
    {
        return view('administrative.admin.salesDone');
    }

    public function detailItemSale(Sale $id)
    {
        $items = $id->detailSales()->paginate(15);
        return view('administrative.admin.DetailSale', compact('id', 'items'));
    }

    public function reprint(Sale $sale)
    {
        $impresora = "//localhost/POS-58";
        $connector = new FilePrintConnector($impresora);
        $printer = new Printer($connector);
        //datos del negocio
        //justificado al centro
        $printer->setjustification(Printer::JUSTIFY_CENTER);
        $printer->text("Eli Makeup Store\n\n");
        $printer->text("Eli Makeup Store\n\n");
        //$img = EscposImage::load(base_path("main.png"));
        //$printer -> graphics($img);

        // $image = new Imagick('public/main.jpg');

        // $image->cropImage(190, 300, 350, 565);
        // $image->resizeImage(256, 350, Imagick::FILTER_CATROM, 0);

        // header("Content-Type: image/png");
        // $printer->text($image->getImageBlob());

        $printer->text("Dirección: Matagalpa, de gasolinera gas central 90mtrs al oeste, contigo a restaurante el" . "\n");
        $printer->text("taquero" . "\n");
        $printer->text("Teléfono: 8841-6715 / 8703-2918" . "\n");
        $img = EscposImage::load('C:\proyectosLaravel\eliStore-vite\public\imagenes\main.jpg', false);
        $printer -> bitImage($img);
        $printer -> bitImageColumnFormat($img);
        $printer -> cut();
        $printer->text("===============================\n");

        //justificar a la derecha
        $printer->setjustification(Printer::JUSTIFY_LEFT);
        //$printer->text("Fecha: ". $newventa->fecha . "\n");
        $printer->text("Fecha: " . Carbon::parse($sale->created_at) . "\n");
        $printer->text("No de factura: " . $sale->numFactura . "\n");
        $printer->text("===============================\n");

         //justificado al centro
         $printer->setjustification(Printer::JUSTIFY_CENTER);
         $printer->text("==================\n");
         $printer->text("Detalle de la venta\n");
         $printer->text("==================\n\n");

         //justificado a la izquierda
         $printer->setjustification(Printer::JUSTIFY_LEFT);
         $fonts = array(Printer::FONT_A, Printer::FONT_B, Printer::FONT_C);
         $printer->text("Producto|" . "Precio|" . "Cantidad|" . "Total" . "\n");
         $printer->text("------------------------------"  . "\n");
         foreach($sale->detailSales as $detailSale)
         {
            $printer->setFont($fonts[2]);
            $printer->text( "* " . $detailSale->product->descripcion . " |" . $detailSale->precio . "|" .  " * " . $detailSale->cantidad . " = " . " " .
             $detailSale->total . "\n");

        }

         $printer->text("=======================\n");
         $printer->text("Total: " . $sale->totalPagado . "\n");
         $printer->text("Cambio: " . $sale->cambio . "\n");
         $printer->text("Atendido por: " . $sale->user->name . "\n");
         $printer->text("Nota: No se aceptan devoluciones" . "\n\n\n\n");
         $printer ->cut();
         $printer ->close();
         Alert::success('Reimpresión', 'Reimpresión realizada exitosamente');
         return back();
    }

    public function categoryExport()
    {
        return Excel::download(new CategoryExport, 'categories.xlsx');
    }

    public function voucherHistory()
    {
        return view('administrative.admin.vouchers-history');
    }

    public function incomesOutcomes()
    {
        return view('administrative.admin.incomes-outcomes');
    }
}
