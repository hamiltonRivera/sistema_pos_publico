{{-- primer fila --}}
<div>
    <div class="mb-3">
        <label for="">Precio de compra</label>
        <input type="number" step="any" name="precio" wire:model="precio" class="inputs-formularios-cortos" required
            disabled>
    </div>
    @error('precio')
        <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
    @enderror
</div>

{{-- segunda fila  --}}
<div>
    <div class="mb-3">
        <button wire:click="addItem([{{ $product_id }}])" class=" boton-verde"><i class="fa-solid fa-cart-plus"></i>
            Añadir a cesta</button>
    </div>

    @if (session()->has('productoSel'))
        <div class="bg-yellow-100 rounded-lg py-5 px-6 mb-3 text-base text-yellow-700 inline-flex items-center w-full"
            style="width: 80%">

            {{ session('productoSel') }}

        </div>
    @endif

</div>
{{-- tercer fila --}}
<div class="mb-3">
    <a href="{{ route('ordersDone') }}" class="boton-gris"><i class="fa-solid fa-eye"></i> Ver ordenes
        realizadas</a>
</div>

{{-- cuarta fila --}}
<div>
    @include('calculadora')
</div>
