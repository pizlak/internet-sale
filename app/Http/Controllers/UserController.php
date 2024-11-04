<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
        public function index(): View
        {
            $user = Auth::user();
            $products = Product::where('count', '>', 0)
                ->orderByDesc('id')
                ->get();

            return view('home', compact('user', 'products'));
        }

        public function profile(User $user): View
        {
            $orders = $user->orders()->where('status', 1)->orderByDesc('id')->limit(3)->get();

            return view('profile', compact('user',  'orders'));
        }
}
