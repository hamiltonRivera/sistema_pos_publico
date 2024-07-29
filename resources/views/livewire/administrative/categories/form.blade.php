<div>
    <div>
        <div class="mb-3">
            <label for="">Categoría</label>
            <input type="text" name="name" wire:model="name" placeholder="Ingresa el nombre de la categoría:"class="inputs-formularios-cortos"required>
        </div>
        @error('name')
        <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <div class="mb-3">
            @if ($selected_id)
            <button type="button" class="boton-verde" wire:click="update()"><i class="fa-solid fa-pen"></i> actualizar</button>
            @else
            <button type="button" class="boton-rosa" wire:click="store()"><i class="fa-solid fa-check"></i> Registrar</button>
            @endif
            <button type="button" class="boton-lima" wire:click="refresh()"><i class="fa-solid fa-arrows-rotate"></i> Refrescar</button>


        </div>
    </div>



<div>
    <label for="">Subida de archivos</label>
</div>
<form wire:submit.prevent="import" enctype="multipart/form-data">


    <div>
        <input name="carga" wire:model="carga" type="file" id="carga" class="input-carga-excel" accept=".xlsx">

        <div wire:loading wire:target="carga" wire:key="carga"><i class="fa-solid fa-atom"></i>Cargando</div>
        <div wire:loading wire:target="import" wire:key="import"><i class="fa-solid fa-atom"></i>Cargando</div>
    </div>

    <button  class="boton-carga-excel mt-2"><i class="fa-solid fa-file-arrow-up"></i> Cargar Archivo</button>
</form>

<div class="mt-3">
    <a href="{{ route('categoryExport') }}" class="boton-carga-excel"><i class="fa-solid fa-file-arrow-down"></i> Exportar archivo</a>
</div>
</div>
