<x-app-layout>
    @include('sweetalert::alert')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Control de usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
             <livewire:administrative.users-control.users-control>
            </div>
        </div>
    </div>
</x-app-layout>
