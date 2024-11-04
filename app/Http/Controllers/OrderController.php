<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $order = Order::where('user_id', Auth::user()->id)
            ->where('status', 0)
            ->first();

        return view('basket', compact('order'));
    }

    public function orderInfo(Order $order): View
    {
        return view('order-info', compact('order'));
    }

    public function addProduct(Product $product): RedirectResponse
    {
        $order = Order::where('user_id', Auth::user()->id)
            ->where('status', 0)
            ->first();

        if (is_null($order)) {
            $order = Order::create(['user_id' => Auth::user()->id]);
        }

        if ($order->products->contains($product->id)) {
            $this->addCountToProduct($order, $product);
        } else {
            $order->products()->attach($product->id);
        }

        return redirect()->route('basket');
    }

    public function removeProduct(Product $product): RedirectResponse
    {
        $order = Order::where('user_id', Auth::user()->id)
            ->where('status', 0)
            ->first();

        if ($order->products->contains($product->id)) {
            $pivot = $order->products()
                ->where('product_id', $product->id)
                ->first()->pivot;

            if ($pivot->count === 1) {
                $order->products()->detach($product->id);

                if(isset($order->products)){
                    $order->delete();
                }
            } else {
                $this->removeCountToProduct($order, $product);
            }
        }

        return redirect()->route('basket');
    }

    private function addCountToProduct(Order $order, Product $product): void
    {
        $pivot = $order->products()
            ->where('product_id', $product->id)
            ->first()
            ->pivot;

        if ($pivot) {
            $pivot->count++;
            $pivot->update();
        }
    }

    private function removeCountToProduct(Order $order, Product $product): void
    {
        $pivot = $order->products()
            ->where('product_id', $product->id)
            ->first()
            ->pivot;

        if ($pivot) {
            $pivot->count--;
            $pivot->update();
        }

    }

    public function completeOrder(): RedirectResponse
    {
        $order = Order::where('user_id', Auth::user()->id)
            ->where('status', 0)
            ->first();

        foreach ($order->products as $product) {

            if($product->count > 0){

                if($product->count > $product->pivot->count){
                    $product->count = $product->count - $product->pivot->count;
                } else {
                    $product->count = 0;
                }

                $product->update();
            }
        }

        $order->status = 1;
        $order->update();

        return redirect()->route('home')->with('success', 'Заказ успешно оформлен!');
    }
}
