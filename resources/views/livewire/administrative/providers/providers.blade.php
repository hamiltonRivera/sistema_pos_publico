<div class="ml-6 mt-5">
  <div class="lg:grid grid-cols-2 sm:grid-col-1">
   {{-- primer columna --}}
   <div>
    @include('livewire.administrative.providers.form')
  </div>

   {{-- segunda columna --}}
    <div>
        {{-- primer fila --}}
        <div>
            @include('livewire.administrative.providers.search')
        </div>

        {{-- segunda fila --}}
        <div>
            @include('livewire.administrative.providers.table')
        </div>
    </div>
  </div>
</div>
