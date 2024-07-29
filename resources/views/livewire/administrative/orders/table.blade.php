<div class="flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="border-b bg-blue-600 text-white">
                        <tr>
                            <th scope="col" class="tr-th">#</th>
                            <th scope="col" class="tr-th">Descripción</th>
                            <th scope="col" class="tr-th">Precio</th>
                            <th scope="col" class="tr-th">Cantidad</th>
                            <th scope="col" class="tr-th">Subtotal</th>
                            <th scope="col" class="tr-th">Opciones</th>
                    </thead>
                    <tbody>
                        @foreach ($detailProduct as $key => $item)
                            <tr class=" text-center">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item['descripcion'] }}</td>
                                <td>{{ $item['precio_compra'] }}</td>
                                <td>{{ $item['cantidad'] }}</td>
                                <td>{{ $item['total'] }}</td>
                                <td>
                                    <button class="boton-amarillo" wire:confirm="Seguro que deseas eliminar el registro?" wire:click="destroy({{ $key }})">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
