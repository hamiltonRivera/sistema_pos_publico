<div class="lg:grid grid-cols-3 sm:grid-col-1">
    @foreach ($settings as $setting)
        {{-- primer columna --}}
        <div>
            @include('livewire.administrative.settings.edit.first')
        </div>

        {{-- segunda columna --}}
        <div>
            @include('livewire.administrative.settings.edit.second')
        </div>

        {{-- tercer fila --}}
        <div>
            @include('livewire.administrative.settings.edit.third')
        </div>
    @endforeach

</div>
