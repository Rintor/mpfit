<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex justify-between">
                    <div>
                        @forelse($orders as $order)
                            <div class="border-b pb-3 mb-4">
                                <div>
                                    <a class="text-green-600 underline" href="{{ route('panel.orders.show', ['order' => $order]) }}">
                                        Заказ #{{ $order->id }}
                                    </a>
                                    <span class="ms-1"> - {{ $order->getStatus() }}</span>
                                    <div>
                                        {{ $order->created_at->translatedFormat('d F Y, H:i:s') }}
                                    </div>
                                    <div>
                                        <span class="font-semibold">ФИО:</span> {{ $order->customer_fullname }}
                                    </div>
                                    <div>
                                        <span class="font-semibold">Сумма:</span> {{ $order->getSum() }} {{ config('currency.symbol') }}
                                    </div>
                                    <div>
                                        <a class="text-gray-600" href="{{ route('panel.orders.edit', ['order' => $order]) }}">
                                            {{ __('edit') }}
                                        </a> /
                                        <form action="{{ route('panel.orders.destroy', ['order' => $order]) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Удалить заказ?')">
                                                {{ __('delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>Заказы не найдены</p>
                        @endforelse

                        <div class="space-y-4 mt-4">{{ $orders->links() }}</div>
                    </div>
                    <div>
                        <ul class="flex gap-3 text-sm leading-normal">
                            <li>
                                <a href="{{ route('panel.orders.create') }}" class="inline-block dark:bg-[#eeeeec] dark:border-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white dark:hover:border-white hover:bg-black hover:border-black px-5 py-1.5 bg-[#1b1b18] rounded-sm border border-black text-white text-sm leading-normal">
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
