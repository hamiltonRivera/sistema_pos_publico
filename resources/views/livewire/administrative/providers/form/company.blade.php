<div>
    <div class="mb-3">
        <label for="">Empresa</label>
        <input type="text" name="empresa" wire:model="empresa" placeholder="empresa:" class="inputs-formularios-cortos form-control" required>
      </div>
      @error('empresa')
      <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
      @enderror
</div>
