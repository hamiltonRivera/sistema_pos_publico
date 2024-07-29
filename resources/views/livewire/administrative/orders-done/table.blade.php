<div class="relative overflow-x-auto">
    <table class="table">
        <thead class="table-thead">
            <tr>
                <th scope="col" class="px-6 py-3">#</th>
                <th scope="col" class="px-6 py-3">Proveedor</th>
                <th scope="col" class="px-6 py-3">Fecha</th>
                <th scope="col" class="px-6 py-3">Total Pagado</th>
                <th scope="col" class="px-6 py-3">Método Pago</th>
                <th scope="col" class="px-6 py-3">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
              <tr class="tr">
                <td class="td">{{ $loop->iteration }}) </td>
                <td class="td">{{ $order->provider->nombreApellido }} </td>
                <td class="td">{{ $order->fecha }} </td>
                <td class="td">{{ $order->totalPagado }}</td>
                <td class="td">{{ $order->metodoPago }}</td>
                <td class="td">
                    <a href="{{ route('detailOrders', $order->id) }}" class="boton-verde" target="_blank"><i class="fa-solid fa-eye"></i> Ver Detalles</a>
                </td>
              </tr>
            @endforeach

        </tbody>
    </table>
    <div class=" flex justify-left">
        <nav aria-label="Page navigation example">
          <ul class="flex list-style-none">
            <li class="page-item disabled ">
              {{ $orders->links() }}
            </li>
          </ul>
        </nav>
      </div>
</div>
