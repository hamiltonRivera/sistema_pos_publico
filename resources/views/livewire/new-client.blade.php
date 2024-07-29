<div>
    <div class="lg:grid grid-cols-2 sm:grid-col-1">
        {{-- primer columna --}}
      <div>
          <div>
            <div class="mb-3">
                <label for="">Nombre y Apellido</label>
                <input type="text" name="nombreApellido" wire:model="nombreApellido" placeholder="nombre y apellido:" class="inputs-formularios-cortos form-control" required>
            </div>
            @error('nombreApellido')
                <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <div class="mb-3">
                <label for="">Ciudad</label>
                <input type="text" name="ciudad" wire:model="ciudad" placeholder="Ciudad:" class="inputs-formularios-cortos form-control" required>
              </div>
              @error('ciudad')
              <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
              @enderror
          </div>
      </div>

      {{-- segunda columna --}}
      <div>
         <div>
            <div class="mb-3">
                <label for="">Dirección</label>
                <input type="text" name="direccion" wire:model="direccion" placeholder="Dirección:" class="inputs-formularios-cortos form-control" required>
              </div>
              @error('direccion')
              <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
              @enderror
         </div>

         <div>
            <div class="mb-3">
                <label for="">Teléfono</label>
                <input type="text" wire:input="addGuiones" name="telefono" wire:model.live="telefono" placeholder="teléfono:" class="inputs-formularios-cortos form-control" required>
              </div>
              @error('telefono')
              <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
              @enderror

         </div>
      </div>
    </div>
      <button type="button" class="boton-verde" wire:click="store()">Registrar</button>
</div>
