<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('panel.products.index') }}">&laquo; back</a> / {{ __('Product') }} #{{ $product->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <table class="table-auto w-full border-collapse border border-gray-300 mt-4">
                    <tbody>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-gray-500">Name</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-gray-500">Description</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $product->description }}</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-gray-500">Price</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $product->price }} {{ config('currency.symbol') }}</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-gray-500">Category</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $product->category->name }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="flex items-center justify-start mt-4">
                    <a href="{{ route('panel.products.edit', ['product' => $product]) }}" class="inline-block dark:bg-[#eeeeec] dark:border-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white dark:hover:border-white hover:bg-black hover:border-black px-5 py-1.5 bg-[#1b1b18] rounded-sm border border-black text-white text-sm leading-normal">
                        {{ __('Edit') }}
                    </a>

                    <form action="{{ route('panel.products.destroy', ['product' => $product]) }}" method="POST" class="inline-block ms-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-block bg-red-600 dark:bg-[#eeeeec] dark:border-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white dark:hover:border-white hover:bg-black hover:border-black px-5 py-1.5 bg-[#1b1b18] rounded-sm border border-black text-white text-sm leading-normal" onclick="return confirm('Удалить товар?')">
                            {{ __('Delete') }}
                        </button>
                    </form>

                    <a class="ms-4 underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('panel.products.index') }}">
                        {{ __('Cancel') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
