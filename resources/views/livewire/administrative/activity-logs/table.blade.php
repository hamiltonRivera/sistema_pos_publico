

<div class="relative overflow-x-auto">
    <table class="table">
        <thead class="table-thead">
            <tr>
                <th scope="col" class="px-6 py-3">#</th>
                <th scope="col" class="px-6 py-3"><i class="fa-solid fa-user"></i> Usuario</th>
                <th scope="col" class="px-6 py-3"><i class="fa-solid fa-note-sticky"></i> Actividad</th>
                <th scope="col" class="px-6 py-3"><i class="fa-solid fa-note-sticky"></i> Detalle</th>
                <th scope="col" class="px-6 py-3">Fecha</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
              <tr class="tr">
                <td class="td">{{ $loop->iteration }}) </td>
                <td class="td">{{ $log->user->name }} </td>
                <td class="td">{{ $log->activity }} </td>
                <td class="td">{{ $log->detail }} </td>
                <td class="td">{{ $log->created_at }} </td>

              </tr>
            @endforeach

        </tbody>
    </table>
    <div class=" flex justify-left">
        <nav aria-label="Page navigation example">
          <ul class="flex list-style-none">
            <li class="page-item disabled ">
              {{ $logs->links() }}
            </li>
          </ul>
        </nav>
      </div>
</div>
