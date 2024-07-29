{{-- primer fila --}}
<div>
    <div class="mb-3">
        <label for="">Teléfono</label>
        <input type="text" wire:input.live="addGuiones" name="telefono" wire:model="telefono" placeholder="teléfono:" class="inputs-formularios-cortos form-control" required>
      </div>
      @error('telefono')
      <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
      @enderror
</div>

{{-- segunda fila --}}
<div>
    <div class="mb-3">
        @if ($selected_id)
        <button type="button" class="boton-verde" wire:click="update()"><i class="fa-solid fa-pen"></i> Actualizar</button>
        @else
        <button type="button" class="boton-rosa" wire:click="store()"><i class="fa-solid fa-check"></i> Registrar</button>
        @endif
        <button type="button" class="boton-azul" wire:click="refresh()"><i class="fa-solid fa-arrows-rotate"></i> Refrescar</button>
    </div>
</div>
