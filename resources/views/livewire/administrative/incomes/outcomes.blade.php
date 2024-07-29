@if ($mostrarGasto)
<br>
<div>
    <div>
        <div class="text-center">
            <label for=""><u>Gastos</u></label>
            <hr>
        </div><br>
        <div class="text-center">
            <label for="" class="text-center">Egresos Totales</label>
        </div>
        <div class="lg:grid grid-cols-2 sm:grid-col-1">
            {{-- primer columna --}}
            <div>
                {{-- primer fila --}}
                <div>
                    <div class="ml-5">
                        <label for="">Selecciona una fecha</label>
                        <input wire:model.lazy="fecha_gasto" wire:change="gastoDelDia()" type="date"
                            class="form-control calendario" min="2021-01-01" max="2030-12-31">
                    </div>
                </div>
            </div>

            {{-- segunda columna --}}
            <div>
                {{-- primer fila --}}
                <div>
                    <div class="">
                        <label for="">Gasto del dia</label>
                        <input type="number" step="any" class="inputs-formularios-cortos"
                            placeholder="gasto del día:" wire:model="gasto_dia" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
