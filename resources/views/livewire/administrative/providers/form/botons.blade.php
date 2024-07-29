<div class="mb-3">
    @if ($selected_id)
    <button type="button" class="boton-verde" wire:click="update()"><i class="fa-solid fa-pen"></i> Actualizar</button>
    @else
    <button type="button" class="boton-azul" wire:click="store()"><i class="fa-solid fa-check"></i> Registrar</button>
    @endif
    <button type="button" class="boton-rosa" wire:click="refresh()"><i class="fa-solid fa-arrows-rotate"></i> Refrescar</button>
</div>
