{{-- primer fila --}}
<div class="mb-3">
    <label for="">fecha</label>
    <input wire:model.lazy="fecha" type="date" name="fecha" class="form-control calendario" min="2021-01-01" max="2030-12-31" required>
    @error('fecha')
    <p class="error">{{ $message }}</p>
@enderror
</div>

{{-- segunda fila  --}}
<div class="mb-3">
    <label for="">Cliente</label>
    <select name="client_id" wire:model="client_id" class="select-formularios form-select"
        aria-label="Default select example">
        <option selected>Selecciona una opción</option>
        @foreach ($clients as $client)
            <option value="{{ $client->id }}">{{ $client->nombreApellido }}</option>
        @endforeach
    </select>
</div>

{{-- tercer fila --}}
<div class="mb-3">
    <div>
        <label for="">Tasa del día</label>
       <input type="text" class="inputs-formularios-cortos" disabled wire:model="exchangeRate" value="{{ $exchangeRate }}">
     </div>
</div>

{{-- cuarta fila --}}
<div class="mb-3">
    <label for="">Total Recibido</label>
    <input max="" class="inputs-formularios-cortos" type="number" step="any" name="totalRecibido" wire:model.lazy="totalRecibido"
        wire:input="cambio">

        @error('totalRecibido')
        <p class="error"> {{ $message }} </p>
    @enderror

    @if (session()->has('message'))

        <div class="bg-red-100 rounded-lg py-5 px-6 mb-3 text-base text-red-700 inline-flex items-center w-full" style="width: 80%">

            {{ session('message') }}

        </div>

    @endif
</div>

{{-- quinta fila --}}
<div class="mb-3">
 @if ($descuentoSel)
 <label for="">Monto Descontado</label>
 <input type="number" step="any" name="totalDescuento" wire:model="totalDescuento" class=" inputs-formularios-cortos"
     required  disabled>
@error('totalDescuento')
 <p class="error"> {{ $message }} </p>
@enderror
 @endif
</div>
{{-- sexta fila --}}
<div class="mb-3">
  @if ($ocultarTotal)
  <label for="">Total a pagar</label>
  <input type="number" step="any" name="totalPagado" wire:model.lazy="totalPagado" wire:input="cambio" required
      class=" inputs-formularios-cortos" required disabled>
@error('totalPagado')
  <p class="alerta-inputs"> {{ $message }} </p>
@enderror
  @endif
</div>
{{-- septima fila --}}
<div class="mb-3">
     @include('calculadora')
</div>

{{-- octava fila --}}
<div class="mb-3">
 @include('newClient')
</div>
