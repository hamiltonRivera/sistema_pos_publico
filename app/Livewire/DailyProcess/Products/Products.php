<?php

namespace App\Livewire\DailyProcess\Products;

use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;
use Livewire\WithPagination;
use App\Models\Category;
use App\Models\Product;
use App\Models\ActivityLog;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;
use App\Imports\ProductImport;
class Products extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search = '', $search_category = '';

    public $descripcion,$stock,$fecha_vencimiento,$precio_compra,$precio_venta_unidad, $precio_venta_mayor,
    $category_id, $codigo, $selected_id, $carga;

    public function render()
    {
        $categories = Category::where('name', 'like', '%' . $this->search_category . '%')->get();

        $products = Product::with('category')
        ->whereRelation('category', 'name', 'like', '%' . $this->search . '%')
        ->orWhere('descripcion', 'like', '%' . $this->search . '%')
        ->orWhere('codigo', 'like', '%' . $this->search . '%')->paginate(10);

        return view('livewire.daily-process.products.products', compact('categories', 'products'));
    }

    public function refresh()
    {
        return redirect('/private/products');
    }

    public function validateCod()
    {
        if(empty($this->codigo))
        {
         $cadena_letras = chr(mt_rand(65,90));
         $cadena_numeros = mt_rand(10000000, 99999999);
         $this->codigo = $cadena_letras . $cadena_numeros;
        }
    }

    public function store()
    {
        $this->validate([
            'descripcion' => 'required|string',
            'stock' => 'required|numeric',
            'fecha_vencimiento' => 'nullable|date',
            'precio_compra' => 'required|numeric',
            'precio_venta_unidad' => 'required|numeric',
            'precio_venta_mayor' => 'required|numeric',
            'codigo' => 'nullable|string',
            'category_id' => 'required'

        ]);

        $newProduct = new Product();
        $newProduct->descripcion = ucfirst(strtolower($this->descripcion));
        $newProduct->stock = $this->stock;
        $newProduct->fecha_vencimiento = $this->fecha_vencimiento;
        $newProduct->precio_compra = $this->precio_compra;
        $newProduct->precio_venta_unidad = $this->precio_venta_unidad;
        $newProduct->precio_venta_mayor = $this->precio_venta_mayor;
        $newProduct->codigo = $this->codigo;
        $newProduct->category_id = $this->category_id;
        $newProduct->codigo = $this->codigo;
        $newProduct->save();

        $newActivitie = new ActivityLog();
        $newActivitie->user_id = auth()->user()->id;
        $newActivitie->activity = "Nuevo Registro - Producto";
        $newActivitie->detail = $newProduct->descripcion;
        $newActivitie->save();

        Alert::success('Categoría', 'Categoría registrada exitosamente');
        $this->refresh();
    }

    public function edit($id)
    {
        $record = Product::findOrFail($id);
        $this->selected_id = $id;
        $this->descripcion = $record->descripcion;
        $this->precio_compra = $record->precio_compra;
        $this->precio_venta_unidad = $record->precio_venta_unidad;
        $this->precio_venta_mayor = $record->precio_venta_mayor;
        $this->stock = $record->stock;
        $this->fecha_vencimiento = $record->fecha_vencimiento;
        $this->category_id = $record->category_id;
        $this->codigo = $record->codigo;
    }

    public function update()
    {
      $validate =  $this->validate([
            'descripcion' => 'required|string',
            'stock' => 'required|numeric',
            'fecha_vencimiento' => 'nullable|date',
            'precio_compra' => 'required|numeric',
            'precio_venta_unidad' => 'required|numeric',
            'precio_venta_mayor' => 'required|numeric',
            'codigo' => 'nullable|string',
            'category_id' => 'required'

        ]);

        if($this->selected_id)
        {
            $record = Product::findOrFail($this->selected_id);
            $record->update($validate);

            $newActivitie = new ActivityLog();
            $newActivitie->user_id = auth()->user()->id;
            $newActivitie->activity = "Registro Actualizado - producto";
            $newActivitie->detail = $record->descripcion;
            $newActivitie->save();

            Alert::success('Producto', 'Producto actualizado exitosamente');
            $this->refresh();
        }
    }

    public function destroy($id)
    {
        $record = Product::findOrFail($id);
        Product::destroy($id);

        $newActivitie = new ActivityLog();
        $newActivitie->user_id = auth()->user()->id;
        $newActivitie->activity = "Registro Eliminado - Producto";
        $newActivitie->detail = $record->descripcion;
        $newActivitie->save();

        Alert::success('Producto', 'Has eliminado el registro');
        $this->refresh();
    }

    public function import()
    {
      $this->validate([
          'carga' => 'required|file|mimes:xlsx|max:3072'
      ]);
      $this->carga->store('subida_archivos', 'public');
      Excel::import(new ProductImport, $this->carga);

      $activity = new ActivityLog();
      $activity->user_id = auth()->user()->id;
      $activity->activity = "Carga de archivo excel - productos";
      $activity->detail = "Subida de archivo";
      $activity->save();

      Alert::success('Carga', 'Carga de archivo exitosa');
      $this->refresh();
    }

    public function categoryStore()
    {
        $this->validate([
            'name' => 'required|string|unique:categories,name,except,id'
        ]);
        
        $newCategory = new Category();
        $newCategory->name = ucfirst(strtolower($this->name));
        $newCategory->save();
        Alert::success('Categoria', 'Categoria registrada exitosamente');
        $this->refresh();
    }
    
}
