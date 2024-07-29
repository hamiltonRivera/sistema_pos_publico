{{-- primer fila --}}
<div>
   <div class="mb-3">
     <label for="">Descripcion del gasto</label>
     <input type="text" wire:model='descripcion' placeholder="Descripcion" class="inputs-formularios-cortos" required>
     @error('descripcion')
     <p class="error">{{ $message }}</p>
     @enderror
   </div>
</div>

{{-- segunda fila --}}
<div>
  <div class="mb-3">
     <label for="">Fecha</label>
     <div class="relative max-w-sm">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
          </svg>
        </div>
        <input wire:model='fecha' datepicker type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-46 ps-10 p-2.5 dark:bg-white dark:border-gray-700 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Fecha">
      </div>
      @error('fecha')
      <p class="error">{{ $message }}</p>
      @enderror
  </div>
</div>

{{-- tercer fila --}}
<div>
  <div class="mb-3">
    <label for="">Monto</label>
    <input type="number" step="any" wire:model='monto' placeholder="monto:" class="inputs-formularios-cortos" required>
    @error('monto')
    <p class="error">{{ $message }}</p>
    @enderror
  </div>
</div>
