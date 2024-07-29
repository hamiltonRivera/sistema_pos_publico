<div class="mb-3">
    <label for="">Precio de venta por mayor</label>
    <input type="number" step="any" name="precio_venta_mayor" wire:model="precio_venta_mayor"
        placeholder="Precio por mayor:" class="inputs-formularios-cortos form-control" required>
</div>
@error('precio_venta_mayor')
    <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
@enderror
