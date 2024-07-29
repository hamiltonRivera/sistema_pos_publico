<div class="ml-5 mt-4">
    <div class="lg:grid grid-cols-2 sm:grid-col-1">
        {{-- primer columna --}}
      <div>
       @include('livewire.administrative.orders.form')
      </div>

      {{-- segunda columna --}}
      <div>
        @include('livewire.administrative.orders.products')
      </div>
    </div>

    @include('livewire.administrative.orders.table')
</div>
