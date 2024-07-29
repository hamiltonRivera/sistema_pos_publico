{{-- primer fila --}}
<div>
    <div class="mb-3">
        <label for="" class="form-label">Método de cancelación</label>
        <select name="metodoPago" wire:model="metodoPago" class="select-formularios form-select"
            aria-label="Default select example">
            <option selected>Selecciona una opción</option>
            @foreach ($metodoPagos as $j)
                <option value="{{ $j }}">{{ $j }}</option>
            @endforeach
        </select>
    </div>
    @error('metodoPago')
        <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
    @enderror
</div>

{{-- segunda fila --}}
<div>
    <div class="mb-3">
        <label for="">Total a pagar</label>
        <input type="number" step="any" class="select-formularios form-select" name="totalPagado"
            wire:model="totalPagado" disabled>
        @error('totalPagado')
            <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
        @enderror
    </div>
</div>

{{-- tercer fila --}}
<div>
    <div class="mb-2">
        <button class="boton-azul" wire:click="store()"><i class="fa-solid fa-pen"></i> registrar</button>
        <button class="boton-rosa mb-3" wire:click="refresh()"><i class="fa-solid fa-arrows-rotate"></i> Refrescar</button>
    </div>
</div>
