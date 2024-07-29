<div>
    <div class="flex justify-center mb-3">
        <div class="block p-6 rounded-lg shadow-lg bg-blue-500 w-100">
          <button wire:click="mostrarVentas()" type="button" class="boton-azul">Ver ventas<i class="fa-solid fa-binoculars"></i></button>
          <button wire:click="mostrarVentaServicio()" type="button" class="ver-detalles">Ver ventas de servicios <i class="fa-solid fa-binoculars"></i></button><br>
          <button wire:click="mostrarVentaTotal()" type="button" class="ver-detalles mt-2">Ver total de ventas <i class="fa-solid fa-binoculars"></i></button>
          <button wire:click="mostrarGasto()" type="button" class="ver-detalles mt-2">Ver total de gastos <i class="fa-solid fa-binoculars"></i></button><br>
          <button wire:click="limpiarEntorno()" type="button" class="ver-detalles mt-2">Limpiar Entorno <i class="fa-solid fa-broom"></i></button>
          <button wire:click="busquedaPersonalizada()" type="button" class="ver-detalles mt-2">Búsqueda personalizada <i class="fa-solid fa-binoculars"></i></button>
        </div>
      </div>
</div>
