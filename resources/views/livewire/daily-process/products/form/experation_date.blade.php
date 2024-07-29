<div class="mb-3">
    <label for="fechaVencimiento">Fecha de vencimiento --opcional--</label>
    <input wire:model.lazy="fecha_vencimiento" type="date" name="fechaVencimiento"
        class="form-control calendario" min="2021-01-01" max="2030-12-31">
</div>
@error('fecha_vencimiento')
    <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
@enderror
