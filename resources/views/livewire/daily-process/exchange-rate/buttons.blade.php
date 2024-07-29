<div class="mb-3">
    @if ($selected_id)
    <button type="button" class="boton-verde" wire:click="update()"><i class="fa-solid fa-pen"></i> Actualizar F2</button>
    @else
    <button type="button" class="boton-azul" wire:click="store()"><i class="fa-solid fa-check"></i> Registrar F1</button>
    @endif
    <button type="button" class="boton-rosa" wire:click="refresh()"><i class="fa-solid fa-arrows-rotate"></i> Refrescar</button>
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
