{{-- primer fila --}}
<div>
    <div class="mb-3">
        <label for="">nombre del negocio</label>
        <input class="inputs-formularios-cortos" value="{{ $setting->nombre }}" disabled>
       </div>
</div>

{{-- segunda fila --}}
<div>
    <div class="mb-3">
        <label for="">Dirección</label>
        <input class="inputs-formularios-cortos" value="{{ $setting->direccion }}" disabled>
       </div>
</div>

{{-- tercer fila --}}
<div>
    <div class="mb-3">
        <label for="">Número RUC</label>
        <input class="inputs-formularios-cortos" value="{{ $setting->ruc }}" disabled>
       </div>
</div>
