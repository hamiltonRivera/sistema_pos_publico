<div>
   <div class="lg:grid grid-cols-4 sm:grid-col-1 ml-4 mb-3">
      {{-- primer columna --}}
      <div>
       @include('livewire.daily-process.sales.columns.first')
      </div>

      {{-- segunda columna --}}
      <div>
        @include('livewire.daily-process.sales.columns.second')
      </div>

      {{-- tercer columna --}}
      <div>
        @include('livewire.daily-process.sales.columns.third')
      </div>

      {{-- cuarta columna --}}
      <div>
        @include('livewire.daily-process.sales.columns.fourth')
      </div>
   </div>

   {{-- tabla --}}
   <div>
    @include('livewire.daily-process.sales.table')
   </div>
</div>
