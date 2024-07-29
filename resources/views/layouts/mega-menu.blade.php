<nav class="bg-white border-gray-200 dark:bg-gray-900 rounded-md">
    @can('administrador')
    <div>
        @include('layouts.mega-menu-items.admin')
    </div>
    @endcan
</nav>
<nav class="bg-white border-gray-200 dark:bg-gray-900 rounded-md">
    <div>
        @can('procesos.diarios')
        @include('layouts.mega-menu-items.daily-operations')
        @endcan
    </div>
</nav>
<nav class="bg-white border-gray-200 dark:bg-gray-900 rounded-md">
    <div>
        @can('procesos.diarios')
        @include('layouts.mega-menu-items.sales')
        @endcan

    </div>
</nav>
