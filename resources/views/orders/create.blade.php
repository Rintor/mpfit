<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('panel.orders.index') }}">&laquo; back</a> / {{ __('Add order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form method="POST" action="{{ route('panel.orders.store') }}">
                    @csrf

                    <!-- Customer Fullname -->
                    <div>
                        <x-input-label for="customer_fullname" :value="__('Customer Fullname')" />
                        <x-text-input id="customer_fullname" class="block mt-1 w-full" type="text" name="customer_fullname" :value="old('customer_fullname')" required autofocus autocomplete="customer_fullname" />
                        <x-input-error :messages="$errors->get('customer_fullname')" class="mt-2" />
                    </div>

                    <!-- Customer Comment -->
                    <div class="mt-4">
                        <x-input-label for="customer_comment" :value="__('Customer Comment')" />
                        <x-text-input id="customer_comment" class="block mt-1 w-full" type="text" name="customer_comment" :value="old('customer_comment')" />
                        <x-input-error :messages="$errors->get('customer_comment')" class="mt-2" />
                    </div>

                    <!-- Product -->
                    <div class="mt-4">
                        <x-input-label for="product_id" :value="__('Product')" />
                        <select id="product_id" name="product_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('product_id')" class="mt-2" />
                    </div>

                    <!-- Product count -->
                    <div class="mt-4">
                        <x-input-label for="product_count" :value="__('Product count')" />
                        <x-text-input id="product_count" class="block mt-1 w-full" type="text" name="product_count" :value="old('product_count') ?? 1" />
                        <x-input-error :messages="$errors->get('product_count')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-start mt-4">
                        <x-primary-button>
                            {{ __('Add') }}
                        </x-primary-button>

                        <a class="ms-4 underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('panel.orders.index') }}">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
