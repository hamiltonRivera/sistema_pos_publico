<div class="relative overflow-x-auto">
    <table class="table">
        <thead class="table-thead">
            <tr>
                <th scope="col" class="px-6 py-3">#</th>
                <th scope="col" class="px-6 py-3">Nombre y apellido</th>
                <th scope="col" class="px-6 py-3">Ciudad</th>
                <th scope="col" class="px-6 py-3">Dirección</th>
                <th scope="col" class="px-6 py-3">Teléfono</th>
                <th scope="col" class="px-6 py-3">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
              <tr class="tr">
                <td class="td">{{ $loop->iteration }}) </td>
                <td class="td">{{ $client->nombreApellido }}</td>
                <td class="td">{{ $client->ciudad }}</td>
                <td class="td">{{ $client->direccion }}</td>
                <td class="td">{{ $client->telefono }}</td>
                <td class="td">
                    <button type="button" class="boton-azul" wire:click="edit({{ $client->id }})">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>

                    <button type="button" class="boton-amarillo" wire:click="destroy({{ $client->id }})" wire:confirm="Seguro que deseas eliminar el registro?">
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
              {{ $clients->links() }}
            </li>
          </ul>
        </nav>
      </div>
</div>
