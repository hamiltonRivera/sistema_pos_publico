<div class="mr-5">
    <div class="lg:grid grid-cols-2 sm:grid-col-1">
       <div>
         <div class="mt-3 ml-4">
            @include('livewire.administrative.categories.form')
         </div>
       </div>

       <div>
        @include('livewire.administrative.categories.search')
        @include('livewire.administrative.categories.table')
       </div>
    </div>
</div>
