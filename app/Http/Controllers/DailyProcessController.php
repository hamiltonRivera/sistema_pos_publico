<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
class DailyProcessController extends Controller
{
    public function products()
    {
        return view('daily-process.products');
    }

    public function outcomes()
    {
        return view('daily-process.gastos');
    }

    public function reports()
    {
        return view('daily-process.reports');
    }

    public function exchangeRate()
    {
        return view('daily-process.exchange-rate');
    }

    public function sales()
    {
        return view('daily-process.sales');
    }

    public function exportProduct()
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }
}
