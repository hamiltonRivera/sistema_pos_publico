<div class="mb-3">
    <label for="">Precio de venta por menor</label>
    <input type="number" step="any" name="precio_venta_unidad" wire:model="precio_venta_unidad"
        placeholder="Precio por menor:" class="inputs-formularios-cortos form-control" required>
</div>
@error('precio_venta_unidad')
    <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
@enderror
