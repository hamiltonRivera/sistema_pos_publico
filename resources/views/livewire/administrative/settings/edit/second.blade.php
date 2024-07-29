{{-- primer fila --}}
<div>
    <div class="mb-3">
        <label for="">Propietario(a)</label>
        <input class="inputs-formularios-cortos" value="{{ $setting->propietario }}" disabled>
       </div>
</div>

{{-- segunda fila --}}
<div>
    <div class="mb-3">
        <label for="">Teléfono</label>
        <input class="inputs-formularios-cortos" value="{{ $setting->telefono }}" disabled>
       </div>
</div>

{{-- tercer fila --}}
<div>
    <div class="mb-3">
        <label for="">Correo</label>
        <input class="inputs-formularios-cortos" value="{{ $setting->email }}" disabled>
       </div>
</div>
