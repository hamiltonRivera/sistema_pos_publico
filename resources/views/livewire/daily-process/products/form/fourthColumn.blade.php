{{-- primer fila --}}
<div>
    @if ($selected_id)
    <button type="button" class="boton-verde" wire:click="update()"><i class="fa-solid fa-pen"></i> Actualizar F2</button>
    @else
    <button type="button" class="boton-azul" wire:click="store()"><i class="fa-solid fa-check"></i> Registrar F1</button>
    @endif
    <button type="button" class="boton-rosa" wire:click="refresh()"><i class="fa-solid fa-arrows-rotate"></i> Refrescar</button>
</div>

{{-- segunda fila--}}
<div class="mt-3 mb-3">
    <button class="boton-gris" wire:click="validateCod()"><i class="fa-solid fa-qrcode"></i> Generar Código F4</button>
</div>

{{-- tercer fila --}}
<div class="mb-3">
 @include('calculadora')
</div>

{{-- cuarta fila --}}
<div class="mt-3 mb-3">
    <a href="{{ route('exportProduct') }}" class="boton-carga-excel"><i class="fa-solid fa-file-arrow-down"></i> Exportar archivo</a>
</div>


