<div class="ml-6">
    <div class="mb-3">
        <label for="">Nombre y apellido</label>
        <input type="text" class="inputs-formularios-cortos" wire:model="name" placeholder="Nombre:"
            required>
    </div>

    <div class="mb-3">
        <label for="">Correo</label>
        <input type="email"
            class="inputs-formularios-cortos"
            wire:model="email" placeholder="Correo:">
</div>

<div class="mb-3">
    <button wire:click="store()" class="boton-verde"><i
            class="fa-solid fa-pen-to-square"></i>Generar Usuario</button>
</div>
@if (session()->has('message'))
    <div class="bg-red-100 rounded-lg py-5 px-6 mb-3 text-base text-red-700 inline-flex items-center w-full"
        style="width: 80%">

        <i class="fa-solid fa-circle-exclamation"></i>   {{ session('message') }}

    </div>
@endif



</div>
