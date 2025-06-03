<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('panel.orders.index') }}">&laquo; back</a> / {{ __('Order') }} #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <table class="table-auto w-full border-collapse border border-gray-300 mt-4">
                    <tbody>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-gray-500">ID</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-gray-500">Customer Fullname</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $order->customer_fullname }}</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-gray-500">Customer Comment</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $order->customer_comment }}</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-gray-500">Status</td>
                            <td class="border border-gray-300 px-4 py-2">
                                {{ $order->getStatus() }}
                                @if($order->status === collect($statuses)->keys()->get(0))
                                    <span class="ms-3">
                                        <form action="{{ route('panel.orders.completed', ['order' => $order]) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="inline-block dark:bg-[#eeeeec] dark:border-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white dark:hover:border-white hover:bg-black hover:border-black px-3 py-1 bg-[#1b1b18] rounded-sm border border-black text-white text-sm leading-normal" onclick="return confirm('Сменить статус заказа на \'Выполнен\'?')">
                                                {{ __('Выполнить') }}
                                            </button>
                                        </form>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-gray-500">Product</td>
                            <td class="border border-gray-300 px-4 py-2">
                                @if($order->product)
                                    {{ $order->product->name }} - {{ $order->product->price }} {{ config('currency.symbol') }}
                                    (count: {{ $order->product_count }})
                                @else
                                    <p>Товар не найден</p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-gray-500">Sum</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $order->getSum() }} {{ config('currency.symbol') }}</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-gray-500">Created</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $order->created_at->translatedFormat('d F Y, H:i:s') }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="flex items-center justify-start mt-4">
                    <a href="{{ route('panel.orders.edit', ['order' => $order]) }}" class="inline-block dark:bg-[#eeeeec] dark:border-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white dark:hover:border-white hover:bg-black hover:border-black px-5 py-1.5 bg-[#1b1b18] rounded-sm border border-black text-white text-sm leading-normal">
                        {{ __('Edit') }}
                    </a>

                    <form action="{{ route('panel.orders.destroy', ['order' => $order]) }}" method="POST" class="inline-block ms-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-block bg-red-600 dark:border-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white dark:hover:border-white hover:bg-black hover:border-black px-5 py-1.5 bg-[#1b1b18] rounded-sm border border-black text-white text-sm leading-normal" onclick="return confirm('Удалить заказ?')">
                            {{ __('Delete') }}
                        </button>
                    </form>

                    <a class="ms-4 underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('panel.orders.index') }}">
                        {{ __('Cancel') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
