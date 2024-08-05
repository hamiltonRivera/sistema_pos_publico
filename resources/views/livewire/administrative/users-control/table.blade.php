<div>
    <div class="lex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="overflow-x-auto">
          <table class="min-w-full">
            <thead class="order-b bg-blue-600 text-white">
               <tr class="text-cente">
                <th scope="col" class="tr-th">#</th>
                <th scope="col" class="px-6 py-3"><i class="fa-solid fa-user"></i> Nombre</th>
                <th scope="col" class="px-6 py-3"><i class="fa-solid fa-envelope"></i> Correo</th>
                <th scope="col" class="px-6 py-3"><i class="fa-solid fa-check-double"></i> Rol Actual</th>
                <th scope="col" class="px-6 py-3"><i class="fa-solid fa-list"></i> Roles</th>
                <th scope="col" class="px-6 py-3"><i class="fa-solid fa-pencil"></i> Opciones</th>
               </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr class="text-center border-b">
                    <td class="tr-td">{{ $loop->iteration }} </td>
                    <td class="tr-td">{{ $user->name }}</td>
                    <td class="tr-td">{{ $user->email }}</td>
                    <td class="tr-td">
                        @if($user->roles->isNotEmpty())
                        <div class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-1"></i>
                            {{ $user->roles->first()->name }}
                        </div>
                    @else
                        <div class="flex items-center">
                            <i class="fas fa-times text-red-500 mr-1"></i>
                            Sin Rol
                        </div>
                    @endif
                    </td>

                    <td class="tr-td">
                        <div class="flex">
                            <select class="p-2 border rounded mr-2" wire:model="selectedRole.{{ $user->id }}">
                                <option value="" selected>Seleccione un rol</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td class="tr-td">
                        <button class="boton-azul" wire:click="assignRoles"><i class="fa-solid fa-pen-to-square"></i> Asignar Rol</button>
                    </td>
                </tr>

                @endforeach
            </tbody>
          </table>
        </div>
        </div>
    </div>
    <div class=" flex justify-left">
        <nav aria-label="Page navigation example">
          <ul class="flex list-style-none">
            <li class="page-item disabled ">
              {{ $users->links() }}
            </li>
          </ul>
        </nav>
      </div>
</div>
