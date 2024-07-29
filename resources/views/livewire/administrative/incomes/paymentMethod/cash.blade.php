<br>

<div>
    <div class="text-center mb-3">
        <label for="">Ventas en efectivo</label>
    </div>
    <div class="lg:grid grid-cols-2 sm:grid-col-1 ml-5">
      {{-- primer columna --}}
      <div>
        {{-- primer fila --}}
        <div>
            <label for="">Selecciona una fecha</label>
            <input wire:model.lazy="fecha_efectivo" wire:change="cierreEfectivo()" type="date" class="form-control calendario" min="2021-01-01" max="2030-12-31">
        </div>
      </div>

      {{-- segunda columna --}}
      <div>
        {{-- primer fila --}}
        <div>
            <label for="">Cierre del día</label>
            <input type="number" step="any" class="inputs-formularios-cortos" placeholder="gasto del día:" wire:model="cierre_efectivo" disabled>
        </div>
      </div>
    </div>
</div>
