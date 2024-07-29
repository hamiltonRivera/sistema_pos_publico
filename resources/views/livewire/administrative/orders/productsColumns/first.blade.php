{{-- primer fila --}}
<diV>
    <div class="mb-3">
    <label for="">Busqueda sensible</label>
    <input wire:model.live="search_product" type="search" placeholder="Descripción del producto:" class=" inputs-formularios-cortos">
</div>
</diV>

{{-- segunda fila --}}
<div>
    <div class="mb-3">
        <label for="" class="form-label">Productos</label>
        <select name="product_id" wire:model="product_id" wire:change="buscarProducto($event.target.value)" class="select-formularios form-select">
            <option value="">Selecciona una opción</option>
            @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->descripcion }}</option>
            @endforeach
        </select>
    </div>
    @error('product_id')
        <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
    @enderror
</div>

{{-- tercer fila --}}
<div>
    <div>
        <div class="mb-3">
          <label for="">Cantidad</label>
          <input type="number" step="any" name="cantidad" wire:model="cantidad"  class="inputs-formularios-cortos" required min="1">
        </div>
        @error('cantidad')
        <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
        @enderror

        @if ($productoSel)
                    <div class="flex w-full max-w-sm overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <div class="flex items-center justify-center w-12 bg-blue-500">
                            <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z" />
                            </svg>
                        </div>

                        <div class="px-4 py-2 -mx-3">
                            <div class="mx-3">
                                <span class="font-semibold text-blue-500 dark:text-blue-400">Info</span>
                                <p class="text-sm text-gray-600 dark:text-gray-200">Producto en stock: {{ $productoSel->stock }}</p>
                            </div>
                        </div>
                    </div>

        @endif
        @if (session()->has('cantidad'))

                  <div class="bg-yellow-100 rounded-lg py-5 px-6 mb-3 text-base text-yellow-700 inline-flex items-center w-full" style="width: 80%">

                      {{ session('cantidad') }}

                  </div>

        @endif
    </div>
</div>
