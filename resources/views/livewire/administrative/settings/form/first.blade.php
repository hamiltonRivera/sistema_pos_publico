{{-- priimer fila --}}
<div>
    <div class="mb-3">
        <label for="">Nombre del negocio</label>
        <input type="text" name="nombre" wire:model="nombre" class="inputs-formularios-cortos" placeholder="Nombre del negocio:" required>
    </div>
    @error('nombre')
    <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
    @enderror
</div>

{{-- segunda fila --}}
<div>
    <div class="mb-3">
        <label for="">Dirección</label>
        <input type="text" name="direccion" wire:model="direccion" class="inputs-formularios-cortos" placeholder="Dirección:" required>
        </div>
        @error('direccion')
        <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
        @enderror
</div>

{{-- tercer fila --}}
<div>
    <div class="mb-3">
        <label for="">Número ruc --opcional--</label>
        <input type="text" name="ruc" wire:model="ruc" class="inputs-formularios-cortos" placeholder="Número RUC:"required>
    </div>
    @error('ruc')
    <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
    @enderror

</div>
