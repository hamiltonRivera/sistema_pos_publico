<div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="border-b bg-blue-600 text-white">
                            <tr class="text-center">
                                <th scope="col" class="tr-th">#</th>
                                <th scope="col" class="tr-th">No de factura</th>
                                <th scope="col" class="tr-th">Fecha</th>
                                <th scope="col" class="tr-th">Método Pago</th>
                                <th scope="col" class="tr-th">Monto</th>
                                <th scope="col" class="tr-th">Descripción</th>
                                <th scope="col" class="tr-th">Cliente</th>
                                <th scope="col" class="tr-th">Realizado por</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $num = 0;
                            @endphp

                            @foreach ($histories as $historial)
                                <tr class="text-center border-b">
                                    <td class="tr-td">{{ $loop->iteration }}) </td>
                                    <td class="tr-td">{{ $historial->numFactura }}</td>
                                    <td class="tr-td">{{ $historial->fecha }}</td>
                                    <td class="tr-td">{{ $historial->metodoPago }}</td>
                                    <td class="tr-td">{{ $historial->monto }}</td>
                                    <td class="tr-td">{{ $historial->descripcion }}</td>
                                    <td class="tr-td">{{ $historial->client->nombreApellido }}</td>
                                    <td class="tr-td">{{ $historial->user->name }}</td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class=" flex justify-left">
        <nav aria-label="Page navigation example">
            <ul class="flex list-style-none">
                <li class="page-item disabled">
                    {{ $histories->links() }}
                </li>
            </ul>
        </nav>
    </div>
</div>
