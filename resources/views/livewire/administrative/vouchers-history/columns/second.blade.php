 {{-- primer fila  --}}
 <div>
    <span>Número de entradas</span>
    <select class="select-formularios" wire:model="cantidad_seleccionada">
        <option selected>Selecciona una cantidad</option>
        @foreach ($entradas as $entrada)
            <option value="{{ $entrada }}">{{ $entrada }}</option>
        @endforeach
    </select>
</div>
