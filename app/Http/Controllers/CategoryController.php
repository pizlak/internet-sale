<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;


class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::orderBy('title', 'asc')->get();

        return view('categories', compact('categories'));
    }

    public function show(string $slug): View
    {
        $category = Category::where('slug', $slug)->first();

        return view('category', compact( 'category'));
    }
}
