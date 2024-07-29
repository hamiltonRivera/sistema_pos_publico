<div class="flex">
    <div>
     <div class="ml-5">
         <input type="search" wire:model.live="search" class="buscador-largo" placeholder="Buscador sensible">
     </div>
    </div>

    <div class="mt-2 mr-2 ml-2">
     <a href="{{ route('createAdminUser') }}" class="boton-azul"><i class="fa-solid fa-user-plus"></i> Crear usuario administrador</a>
    </div>

    <div class="mt-2">
      <a href="{{ route('createCashierUser') }}" class="boton-azul"><i class="fa-solid fa-user-plus"></i> crear usuario caja</a>
    </div>
 </div>
