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
                    Вы авторизовались.
                    Вам доступно управление <a href="{{ route('panel.products.index') }}" class="underline text-green-600">товарами</a> и <a href="{{ route('panel.orders.index') }}" class="underline text-green-600">заказами</a>.
                    Категории заполняются через php artisan db:seed
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
