<div>
    <div class="lg:grid grid-cols-2 sm:grid-col-1">
      {{-- primer columna --}}
      <div>
        <img src="{{ asset('images/balance.jpg') }}" class="img-fluid" alt="">
      </div>

      {{-- segunda columna --}}
      <div class="ml-3 mb-3">
         {{-- primer fila botones --}}
         <div>
            @include('livewire.administrative.incomes.botons-menu')
         </div>

         {{-- segunda fila inputs --}}
         <div class="">
            @include('livewire.administrative.incomes.inputs')
         </div>
      </div>


    </div>
</div>
