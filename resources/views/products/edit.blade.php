<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('panel.products.index') }}">&laquo; back</a> / {{ __('Edit product') }} #{{ $product->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form method="POST" action="{{ route('panel.products.update', ['product' => $product->id]) }}">
                    @csrf
                    @method('PATCH')

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$product->name" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Price -->
                    <div class="mt-4">
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number" step="0.01" name="price" :value="$product->price" required autocomplete="price" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <!-- Category -->
                    <div class="mt-4">
                        <x-input-label for="category_id" :value="__('Category')" />
                        <select id="category_id" name="category_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Description')" />
                        <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="$product->description" />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-start mt-4">
                        <x-primary-button>
                            {{ __('Update') }}
                        </x-primary-button>

                        <a class="ms-4 underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('panel.products.index') }}">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
