<div>
    {{-- buscador --}}

     <div class="flex">
       <div class="mr-3">
        <label for="">Fecha Inicio</label>
           <input datepicker type="date" wire:model.live="start_costum_search" class="form-control calendario" placeholder="Fecha Fin" required>
       </div>
       <div>
        <label for="">Fecha fin</label>
        <input datepicker type="date" wire:model.live="end_costum_search" class="form-control calendario" placeholder="Fecha Fin" required>
       </div>
     </div>

    {{-- tabla --}}
<div>
    @include('livewire.administrative.best-selling-products.dayli-table')
   </div>
</div>


