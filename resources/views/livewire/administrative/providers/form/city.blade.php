<div>
    <div class="mb-3">
        <label for="">Ciudad</label>
        <input type="text" name="ciudad" wire:model="ciudad" placeholder="Ciudad:" class="inputs-formularios-cortos form-control" required>
      </div>
      @error('ciudad')
      <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
      @enderror
</div>
