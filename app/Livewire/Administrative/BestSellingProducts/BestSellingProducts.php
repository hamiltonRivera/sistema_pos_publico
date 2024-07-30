<?php

namespace App\Livewire\Administrative\BestSellingProducts;

use Livewire\Component;
use App\Models\Sale;
use Livewire\WithPagination;

class BestSellingProducts extends Component
{
    use WithPagination;
    public $start_costum_search = '', $end_costum_search = '';
    public function render()
    {


        //algoritmo para recuperar los productos
      $products = Sale::with('detailSales.products')
    ->whereBetween('fecha', [$this->start_costum_search, $this->end_costum_search])
    ->orderBy('id', 'asc')
    ->paginate(10);

        return view('livewire.administrative.best-selling-products.best-selling-products', compact('products'));
    }
}
