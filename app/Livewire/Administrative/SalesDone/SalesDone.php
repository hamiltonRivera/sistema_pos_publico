<?php

namespace App\Livewire\Administrative\SalesDone;

use Livewire\Component;
use App\Models\Sale;
use Livewire\WithPagination;
class SalesDone extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    public $search = '';
    public function render()
    {
        $sales = Sale::with('user', 'client')
         ->whereRelation('user', 'name', 'like', '%' . $this->search . '%')
         ->orWhereRelation('client', 'nombreApellido', 'like', '%' . $this->search . '%')
         ->orWhereAny(['fecha', 'numFactura'], 'like', '%' . $this->search . '%')->paginate(10);
        return view('livewire.administrative.sales-done.sales-done', compact('sales'));
    }
}
