{{-- primer fila --}}
<div class="mb-3">
    <label for="">Productos</label>
    <input type="text" wire:model="product_id" placeholder="{{ optional($productSel)->descripcion }}" disabled
        class="inputs-formularios-cortos" required>
    @error('product_id')
        <p class="error">{{ $message }}</p>
    @enderror
    @if (session()->has('producto'))
        <div class="bg-red-100 rounded-lg py-5 px-6 mb-3 text-base text-red-700 inline-flex items-center w-full"
            style="width: 80%">

            {{ session('producto') }}

        </div>
    @endif
</div>
{{-- segunda fila --}}
<div class="mb-3">
    <label for="">Precio</label>
    <input type="number" name="precio" wire:model="precio" class="inputs-formularios-cortos" required disabled
        value="{{ optional($productSel)->precio_venta_unidad }}">
    @error('precio')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

{{-- tercer fila --}}
<div class="mb-3">
    <label for="">Descuento individual</label>
    <div>
        <div class="form-check">
            <input value="Si" wire:model="descuento_individual" wire:change="mostarDescuentoIndividual()"
                class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                type="radio" name="flexRadioDefault" id="flexRadioDefault1">
            <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault1">
                Si
            </label>
        </div>
        <div class="form-check">
            <input value="No" wire:model="descuento_individual"
                class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                type="radio" name="flexRadioDefault" id="flexRadioDefault2">
            <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault2">
                No
            </label>
        </div>
    </div>
    @if ($ver_descuento_individual)
        <select name="descuento" wire:model="descuento_i" wire:change="mostarDescuentoIndividual()"
            class="select-formularios form-select" select-formularios form-select" aria-label="Default select example">
            <option selected>Selecciona el descuento</option>
            @foreach ($descuentos as $descuento)
                <option value="{{ $descuento }}">{{ $descuento }}%</option>
            @endforeach
        </select>
    @endif
</div>

{{-- cuarta fila --}}
<div class="mb-3">
    <button wire:click="addItem([{{ $product_id }}])" class=" boton-lima"><i class="fa-solid fa-cart-plus"></i> Añadir a cesta</button>
</div>
