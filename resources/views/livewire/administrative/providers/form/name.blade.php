<div>
    <div class="mb-3">
        <label for="">Nombre y Apellido</label>
        <input type="text" name="nombreApellido" wire:model="nombreApellido" placeholder="nombre y apellido:" class="inputs-formularios-cortos form-control" required>
    </div>
    @error('nombreApellido')
        <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
    @enderror
</div>
