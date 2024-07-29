{{-- tercer fila --}}
<div>
    <div class="mb-3">
        <label for="">Número de recibo consecutivo</label>
        <input class="inputs-formularios-cortos" value="{{ $setting->consecutivo }}" disabled>
       </div>
</div>

{{-- segunda fila --}}
<div>
    <div class="mb-3">
        <button class="boton-verde" wire:click="edit({{ $setting->id }})"><i class="fa-solid fa-pen"></i> Editar</button>
       </div>
</div>

{{-- tercer fila --}}
<div>

</div>
