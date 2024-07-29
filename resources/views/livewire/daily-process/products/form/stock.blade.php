<div class="mb-3">
    <label for="">Existencia</label>
    <input type="number" name="stock" wire:model="stock" placeholder="Existencia:"
        class="inputs-formularios-cortos form-control" required>
</div>
@error('stock')
    <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
@enderror
