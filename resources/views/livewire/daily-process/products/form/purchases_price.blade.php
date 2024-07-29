<div class="mb-3">
    <label for="">Precio de compra</label>
    <input type="number" step="any" name="precio_compra" wire:model="precio_compra"
        placeholder="Precio de compra" class="inputs-formularios-cortos form-control" required>
</div>
@error('precio_compra')
    <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
@enderror
