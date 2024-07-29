<div>
    <form wire:submit.prevent="import" enctype="multipart/form-data">


        <div>
            <input name="carga" wire:model="carga" type="file" id="carga" class="input-carga-excel" accept=".xlsx">

            <div wire:loading wire:target="carga" wire:key="carga"><i class="fa-solid fa-atom"></i>Cargando</div>
            <div wire:loading wire:target="import" wire:key="import"><i class="fa-solid fa-atom"></i>Cargando</div>
        </div>

        <button  class="boton-carga-excel mt-2"><i class="fa-solid fa-file-arrow-up"></i> Cargar</button>
    </form>
</div>
