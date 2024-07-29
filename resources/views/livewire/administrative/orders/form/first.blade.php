{{-- primer fila --}}
<div>
        <div class="mb-3">
            <label for="">Busqueda sensible</label>
            <input wire:model.live="search_provider" type="search" placeholder="Nombre del proveedor" class=" inputs-formularios-cortos">
        </div>
</div>

{{-- segunda fila --}}
<div>
    <div class="mb-3">
        <label for="" class="form-label">Proveedor</label>
        <select name="provider_id" wire:model="provider_id" class="select-formularios form-select"
            aria-label="Default select example">
            <option selected>Selecciona una opción</option>
            @foreach ($providers as $provider)
                <option value="{{ $provider->id }}">{{ $provider->nombreApellido }}</option>
            @endforeach
        </select>
    </div>
    @error('provider_id')
        <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
    @enderror
</div>

{{-- tercer fila  --}}
<div>
    <div>
        <div class="mb-3">
            <label for="">Fecha del pedido</label>
            <input wire:model.lazy="fecha" type="date" name="fecha" class="form-control calendario" min="2021-01-01"
                max="2030-12-31" required>
        </div>
        @error('fecha')
            <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
        @enderror
    </div>
</div>
