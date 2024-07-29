<x-app-layout>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('sweetalert::alert')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles de la venta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              @include('administrative.admin.detailSaleTable')
            </div>
        </div>
    </div>
</x-app-layout>
