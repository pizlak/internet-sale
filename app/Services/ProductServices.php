<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductServices
{
    public function __construct()
    {
        //
    }
    public function createProduct($data, $request): void
    {
        unset($data['_token']);
        $data['image'] = $request->file('image')->store('images', 'public');
        $data['user_id'] = Auth::user()->id;
        Product::firstOrCreate($data);
    }
}
