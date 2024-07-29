

<div class="relative overflow-x-auto mr-5">
    <table class="table">
        <thead class="table-thead">
            <tr>
                <th scope="col" class="px-6 py-3">#</th>
                <th scope="col" class="px-6 py-3">Fecha</th>
                <th scope="col" class="px-6 py-3">Valor</th>
                <th scope="col" class="px-6 py-3">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasas as $tasa)
              <tr class="tr">
                <td class="td">{{ $loop->iteration }}) </td>
                <td class="td">{{ $tasa->fecha }} </td>
                <td class="td">{{ $tasa->valor }} </td>
                <td class="td">
                    <button type="button" class="boton-azul" wire:click="edit({{ $tasa->id }})">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>

                    <button type="button" class="boton-amarillo" wire:click="destroy({{ $tasa->id }})" wire:confirm="Seguro que deseas eliminar el registro?">
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
              {{ $tasas->links() }}
            </li>
          </ul>
        </nav>
      </div>
</div>
