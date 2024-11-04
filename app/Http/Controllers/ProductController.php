<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\FilterProductRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\ProductServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function soldProducts(User $user): View
    {
        $products = $user->products;

        return view('products-sold', compact('products'));
    }

    public function purchasedProducts(User $user): View
    {
        $purchasedProducts = [];
        foreach ($user->orders as $order) {
            foreach ($order->products as $product) {
                if(isset($purchasedProducts[$product->id])) {
                    $purchasedProducts[$product->id]['count'] += $product->pivot->count;
                } else {
                    $purchasedProducts[$product->id] = [
                      'product' => $product,
                      'count' => $product->pivot->count,
                        'sold_user' => $product->user
                    ];
                }
            }
        }

        return view('products-purchased', compact('user', 'purchasedProducts'));
    }

    public function getUserProducts(User $user, Request $request):  View
    {
        $column = $request->input('column') ?? 'id';
        $method = $request->input('method') ?? 'asc';

        $products = $user->products()
            ->orderBy($column, $method)->get();

        return view('products', compact('products', 'request'));
    }
    public function getAllProducts(Request $request):  View
    {
        $column = $request->input('column') ?? 'id';
        $method = $request->input('method') ?? 'asc';

        $products = Product::where('count', '>', 0)
            ->orderBy($column, $method)->get();

        return view('products', compact('products', 'request'));
    }

    public function index(): View
    {
        $categories = Category::get();

        return view('add-product', compact('categories'));
    }

    public function show(Product $product): View
    {
        return view('product', compact('product'));
    }

    public function create(CreateProductRequest $request, ProductServices $service): RedirectResponse
    {
        $data = $request->validated();
        $service->createProduct($data, $request);

        return redirect()->route('home');
    }
}
