<div class="mb-3">
    <label for="">Descripción</label>
    <input type="text" name="descripcion" wire:model="descripcion" placeholder="Descripción:"
        class="inputs-formularios-cortos form-control" required>
</div>
@error('descripcion')
    <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
@enderror
