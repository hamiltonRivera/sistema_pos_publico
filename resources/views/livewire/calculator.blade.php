<div>
    <div style="padding-left: 10px">
        <div class="mb-3">
            <label for="fecha">Fecha</label>
          <input disabled wire:model="fecha" wire:change="calcular"  type="date" name="fecha" class="form-control calendario" min="2021-01-01" max="2030-12-31" style="width: 180px">
        </div>
      </div>

      <div style="padding-left: 10px">
        <div class="mb-3">
            <label for="">Cantidad en dólar a calcular</label>
          <input  type="number" wire:model="cantidad" wire:change="calcular"  class="select-formularios form-select">
        </div>
      </div>

      <div style="padding-left: 10px">
        <div class="mb-3">
            <label for="">Total</label>
          <input disabled  type="number" step="any" wire:model="total"  class="select-formularios form-select">
        </div>
      </div>
</div>
