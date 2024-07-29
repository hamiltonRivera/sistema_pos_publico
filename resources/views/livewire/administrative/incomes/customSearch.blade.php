@if($mostrarBusquedaPersonalizada)
<br>
<div>
    <div>
        <div class="text-center">
            <label for=""><u>Búsqueda Personalizada</u></label>
            <hr>
        </div><br>

        <div class="lg:grid grid-cols-2 sm:grid-col-1">
            {{-- primer columna --}}
            <div>
                {{-- primer fila --}}
                <div>
                    <div class="ml-5 mb-2">
                        <label for="">Fecha Inicio</label>
                        <input wire:model.lazy="fecha_inicio" wire:change="customResearching()" type="date"
                            class="form-control calendario" min="2021-01-01" max="2030-12-31">
                    </div>
                </div>

                {{-- segunda fila --}}
                <div>
                    <div class="ml-5">
                        <label for="">Fecha Fin</label>
                        <input wire:model.lazy="fecha_fin" wire:change="customResearching()" type="date"
                            class="form-control calendario" min="2021-01-01" max="2030-12-31">
                    </div>
                </div>
            </div>

            {{-- segunda columna --}}
            <div>
                {{-- primer fila --}}
                <div>
                    <div class="">
                        <label for="">Monto total</label>
                        <input type="text" class="inputs-formularios-cortos"
                            placeholder="Monto:" wire:model="custom_date" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
