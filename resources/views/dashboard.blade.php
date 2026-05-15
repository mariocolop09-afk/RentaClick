<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h3 class="text-lg font-bold mb-4">Bienvenido {{ auth()->user()->name }}</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('products.my') }}" class="block p-4 bg-blue-600 text-white rounded-lg text-center font-bold">
                            Mis Productos
                        </a>

                        <a href="{{ route('rentals.my') }}" class="block p-4 bg-gray-800 text-white rounded-lg text-center font-bold">
                            Mis Alquileres
                        </a>

                        <a href="{{ route('payments.my') }}" class="block p-4 bg-green-600 text-white rounded-lg text-center font-bold">
                            Mis Pagos
                        </a>

                        <a href="{{ route('payments.earnings') }}" class="block p-4 bg-yellow-500 text-white rounded-lg text-center font-bold">
                            Mis Ingresos
                        </a>

                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="block p-4 bg-red-600 text-white rounded-lg text-center font-bold md:col-span-2">
                                Panel Admin
                            </a>
                        @endif
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
