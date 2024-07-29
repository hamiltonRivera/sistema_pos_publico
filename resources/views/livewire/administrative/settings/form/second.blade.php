{{-- primer fila --}}
<div>
    <div class="mb-3">
        <label for="">Propietario(a)</label>
        <input type="text" name="propietario" wire:model="propietario" class="inputs-formularios-cortos" placeholder="Propietario(a):" required>
    </div>
    @error('propietario')
    <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
    @enderror
</div>

{{-- segunda fila --}}
<div>
    <div class="mb-3">
        <label for="">Teléfono</label>
        <input type="tel" name="telefono" wire:model="telefono" class="inputs-formularios-cortos" placeholder="Teléfono:" required>
      </div>
      @error('telefono')
      <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
      @enderror
</div>

{{-- tercer fila --}}
<div>
    <div class="mb-3">
        <label for="">Correo --opcional--</label>
        <input type="email" name="email" wire:model="email" class="inputs-formularios-cortos" placeholder="Correo:">
      </div>
      @error('email')
      <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
      @enderror
</div>
