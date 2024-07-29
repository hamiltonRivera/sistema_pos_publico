<?php

namespace App\Livewire\Administrative\Categories;

use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;
use Livewire\WithPagination;
use App\Models\Category;
use App\Models\ActivityLog;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;
use App\Imports\CategoryImport;
class Categories extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search = '';

     public $name, $selected_id, $carga;
    public function render()
    {
        $categories = Category::orderBy('id', 'asc')
        ->where('name', 'like', '%' . $this->search . '%')->paginate(10);
        return view('livewire.administrative.categories.categories', compact('categories'));
    }

    public function refresh()
    {
       return redirect ('/private/admin/categories');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|unique:categories,name|min:5'
        ]);
        $newCategorie = new Category();

        $newCategorie->name = ucwords(strtolower($this->name));
        $newCategorie->save();

        $newActivitie = new ActivityLog();
        $newActivitie->user_id = auth()->user()->id;
        $newActivitie->activity = "Nuevo Registro - categoría";
        $newActivitie->detail = $newCategorie->name;
        $newActivitie->save();

        Alert::success('Categoría', 'Categoría registrada exitosamente');
        $this->refresh();
    }

    public function edit($id)
    {
       $record = Category::findOrFail($id);
       $this->selected_id = $id;
       $this->name = $record->name;
    }

    public function update()
    {
       $this->validate([
           'name' => 'required|string'
       ]);

       if($this->selected_id){
            $record = Category::findOrFail($this->selected_id);
            $record->update([
                'name' => ucwords(strtolower($this->name))
            ]);

            $newActivitie = new ActivityLog();
            $newActivitie->user_id = auth()->user()->id;
            $newActivitie->activity = "Registro Modificado - categoría";
            $newActivitie->detail = $record->name;
            $newActivitie->save();
           Alert::success('Categoría', 'Categoría actualizada exitosamente');
           $this->refresh();
       }

    }

    public function destroy($id)
    {
        $record = Category::findOrFail($id);

        $activity = new ActivityLog();
        $activity->user_id = auth()->user()->id;
        $activity->activity = "Registro Eliminado - categoría";
        $activity->detail = $record->name;
        $activity->save();

       Category::destroy($id);
       Alert::warning('Categoría', 'Has eliminado el registro!');
       $this->refresh();
    }

    public function import()
    {
      $this->validate([
          'carga' => 'required|file|mimes:xlsx|max:3072'
      ]);
      $this->carga->store('subida_archivos', 'public');
      Excel::import(new CategoryImport, $this->carga);

      $activity = new ActivityLog();
      $activity->user_id = auth()->user()->id;
      $activity->activity = "Carga de archivo excel - categoría";
      $activity->detail = "Subida de archivo";
      $activity->save();

      Alert::success('Carga', 'Carga de archivo exitosa');
      $this->refresh();
    }


}
