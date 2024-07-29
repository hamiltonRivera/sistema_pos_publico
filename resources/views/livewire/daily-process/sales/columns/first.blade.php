{{-- primer fila --}}
<div class="mb-3">
    <label for="">No de factura</label>
    <input type="number" step="any" name="numFactura" wire:model="numFactura"
        class="inputs-formularios-cortos" required disabled>
        @error('numFactura')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

{{-- segunda fila --}}
<div class="mb-3">
    <label for="">Búsqueda sensible --cliente--</label>
    <input type="search" wire:model.live="search_client" class="inputs-formularios-cortos"
        placeholder="Búsqueda de cliente">
        @error('client_id')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

{{-- tercer fila --}}
<div class="mb-3">
    <label for="">Método de pago</label>
    <select wire:model="metodoPago" wire:change="pagoTransferencia" class="select-formularios form-select" aria-label="Default select example">
      <option selected>Selecciona una opción</option>
      @foreach ($metodos as $metodo)
         <option value="{{ $metodo }}">{{ $metodo }}</option>
      @endforeach
    </select>
    @error('metodoPago')
    <p class="error">{{ $message }}</p>
    @enderror
</div>

{{-- cuarta fila --}}
<div class="mb-3">
    <label for="">Descuento total de la venta</label>
    <select name="descuento" wire:model="descuento" wire:change="mostrarDescuento()" class="select-formularios form-select" aria-label="Default select example">
        <option selected>Selecciona el descuento</option>
        @foreach ($descuentos as $descuento)
            <option value="{{ $descuento }}">{{ $descuento }}%</option>
        @endforeach
    </select>
</div>

{{-- quinta fila --}}
<div class="mb-3">

    <label for="">Cambio</label>
    <input type="number" step="any" name="cambio" wire:model="cambio" class="inputs-formularios-cortos" required disabled>
@error('cambio')
    <p class="error"> {{ $message }} </p>
@enderror


</div>

{{-- sexta fila --}}
<div class="mb-3">
    @if ($descuentoSel)
    <label for="">Total a pagar --descuento aplicado--</label>
    <input type="number" name="totalPagadoDescuento" wire:model="totalPagadoDescuento" class="inputs-formularios-cortos" disabled>
@error('totalPagadoDescuento')
    <p class="alerta-inputs"> {{ $message }} </p>
@enderror
    @endif
</div>
{{-- septima fila --}}
<div class="mb-3">

        <button wire:click="store()" class="boton-rosa"><i class="fa-solid fa-check"></i> Realizar venta</button>
</div>

{{-- octava fila --}}
<div>
    <a href="{{ route('salesDone') }}" class="boton-rosa"><i class="fa-solid fa-eye"></i> Ver ventas Realizadas</a>
</div>

