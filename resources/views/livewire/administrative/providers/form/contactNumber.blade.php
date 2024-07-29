<div>
    <div class="mb-3">
        <label for="">Teléfono</label>
        <input type="text" name="telefono" max="9" wire:model="telefono" placeholder="teléfono:" class="inputs-formularios-cortos form-control" required>
      </div>
      @error('telefono')
      <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
      @enderror
</div>
