<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex justify-between">
                    <div>
                        @forelse($products as $product)
                            <div class="border-b pb-3 mb-4">
                                <div>
                                    <a class="text-green-600 underline" href="{{ route('panel.products.show', ['product' => $product]) }}">
                                        {{ $product->name }}
                                    </a>
                                </div>
                                <div>
                                    {{ $product->price }} {{ config('currency.symbol') }} / категория: {{ $product->category->name }}
                                </div>
                                <div>
                                    <a class="text-gray-600" href="{{ route('panel.products.edit', ['product' => $product]) }}">
                                        {{ __('edit') }}
                                    </a> /
                                    <form action="{{ route('panel.products.destroy', ['product' => $product]) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Удалить товар?')">
                                            {{ __('delete') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p>Товары не найдены</p>
                        @endforelse

                        <div class="space-y-4 mt-4">{{ $products->links() }}</div>
                    </div>
                    <div>
                        <ul class="flex gap-3 text-sm leading-normal">
                            <li>
                                <a href="{{ route('panel.products.create') }}" class="inline-block dark:bg-[#eeeeec] dark:border-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white dark:hover:border-white hover:bg-black hover:border-black px-5 py-1.5 bg-[#1b1b18] rounded-sm border border-black text-white text-sm leading-normal">
                                    {{ __('Add') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
