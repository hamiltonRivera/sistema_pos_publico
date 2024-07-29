<div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="border-b bg-blue-600 text-white">
                            <tr class="text-center">
                                <th scope="col" class="tr-th">#</th>
                                <th scope="col" class="tr-th">Producto</th>
                                <th scope="col" class="tr-th">Precio</th>
                                <th scope="col" class="tr-th">Cantidad</th>
                                <th scope="col" class="tr-th">Total</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $num = 0;
                            @endphp

                            @foreach ($items as $item)
                              <tr class="text-center border-b">
                                <td class="tr-td">{{ $loop->iteration }}</td>
                                <td class="tr-td">{{ $item->product->descripcion }}</td>
                                <td class="tr-td">{{ $item->precio }}</td>
                                <td class="tr-td">{{ $item->cantidad }}</td>
                                <td class="tr-td">{{ $item->total }}</td>
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
              {{ $items->links() }}
            </li>
          </ul>
        </nav>
      </div>
</div>
