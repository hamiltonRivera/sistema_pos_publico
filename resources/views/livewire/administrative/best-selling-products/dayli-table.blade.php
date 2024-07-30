<div class="relative overflow-x-auto">
    <table class="table">
        <thead class="table-thead">
            <tr>
                <th scope="col" class="px-6 py-3">#</th>
                <th scope="col" class="px-6 py-3">Descripcion</th>
                <th scope="col" class="px-6 py-3">Stock Actual</th>

            </tr>
        </thead>
        <tbody>
             @foreach ($products as $product)
              <tr class="tr">
                <td class="td">{{ $loop->iteration }})</td>
                    <td class="td">{{ $product->description }}</td>
                    <td class="td">{{ $product->stock }}</td>

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
