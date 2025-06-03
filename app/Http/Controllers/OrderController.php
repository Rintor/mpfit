<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $items = Order::orderBy('created_at', 'desc')->paginate(10);

        return view('orders.index', [
            'orders' => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $products = Product::all();

        return view('orders.create', [
            'products' => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'customer_fullname' => ['required', 'string', 'max:255'],
            'customer_comment' => ['nullable', 'string', 'max:255'],
            'product_id' => ['required', 'exists:products,id'],
            'product_count' => ['required', 'numeric', 'min:1'],
        ]);

        Order::create([
            'customer_fullname' => $request->customer_fullname,
            'customer_comment' => $request->customer_comment,
            'product_id' => $request->product_id,
            'product_count' => $request->product_count,
        ]);

        return redirect(route('panel.orders.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order): View
    {
        $order->load('product');

        $statuses = Order::getStatuses();

        return view('orders.show', [
            'order' => $order,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order): View
    {
        $products = Product::all();
        $statuses = Order::getStatuses();

        return view('orders.edit', [
            'order' => $order,
            'products' => $products,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order): RedirectResponse
    {
        $request->validate([
            'customer_fullname' => ['required', 'string', 'max:255'],
            'customer_comment' => ['nullable', 'string', 'max:255'],
            'product_id' => ['required', 'exists:products,id'],
            'product_count' => ['required', 'numeric', 'min:1'],
            'status' => ['required', 'in:' . implode(',', array_keys(Order::getStatuses()))],
        ]);

        $order->update([
            'customer_fullname' => $request->customer_fullname,
            'customer_comment' => $request->customer_comment,
            'product_id' => $request->product_id,
            'product_count' => $request->product_count,
            'status' => $request->status,
        ]);

        return redirect(route('panel.orders.show', ['order' => $order]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();

        return redirect(route('panel.orders.index'));
    }

    /**
     * Change status
     */
    public function setCompleted(Order $order): RedirectResponse
    {
        $statuses = Order::getStatuses();

        $set = collect($statuses)->keys()->get(1);

        if ($order->status !== $set) {
            $order->update([
                'status' => $set,
            ]);
        }

        return redirect(route('panel.orders.show', [
            'order' => $order
        ]));
    }
}
