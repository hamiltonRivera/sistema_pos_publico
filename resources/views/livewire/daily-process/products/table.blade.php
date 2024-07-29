

<div class="relative overflow-x-auto mr-5">
    <table class="table">
        <thead class="table-thead">
            <tr>
                <th scope="col" class="px-6 py-3">#</th>
                <th scope="col" class="px-6 py-3">Descripción</th>
                <th scope="col" class="px-6 py-3">Código</th>
                <th scope="col" class="px-6 py-3">Stock</th>
                <th scope="col" class="px-6 py-3">Fecha vencimiento</th>
                <th scope="col" class="px-6 py-3">Precio compra</th>
                <th scope="col" class="px-6 py-3">Precio venta Unidad</th>
                <th scope="col" class="px-6 py-3">Precio venta mayor</th>
                <th scope="col" class="px-6 py-3">Categoria</th>
                <th scope="col" class="px-6 py-3">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
              <tr class="tr">
                <td class="td">{{ $loop->iteration }}) </td>
                <td class="td">{{ $product->descripcion }} </td>
                <td class="td">{{ $product->codigo }} </td>
                <td class="td">{{ $product->stock }}</td>
                <td class="td">{{ $product->fecha_vencimiento }}</td>
                <td class="td">{{ $product->precio_compra }}</td>
                <td class="td">{{ $product->precio_venta_unidad }}</td>
                <td class="td">{{ $product->precio_venta_mayor }}</td>
                <td class="td">{{ $product->category->name }}</td>
                <td class="td">
                    <button type="button" class="boton-azul" wire:click="edit({{ $product->id }})">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>

                    <button type="button" class="boton-amarillo" wire:click="destroy({{ $product->id }})" wire:confirm="Seguro que deseas eliminar el registro?">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
              </tr>
            @endforeach

        </tbody>
    </table>
    <div class=" flex justify-left">
        <nav aria-label="Page navigation example">
          <ul class="flex list-style-none">
            <li class="page-item disabled ">
              {{ $products->links() }}
            </li>
          </ul>
        </nav>
      </div>
</div>
