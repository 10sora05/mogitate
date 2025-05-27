<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
$keyword = $request->input('keyword');
    $sort = $request->input('sort');

    $query = Product::query();

    if (!empty($keyword)) {
        $query->where('name', 'like', "%{$keyword}%");
    }

    if ($sort === 'price_asc') {
        $query->orderBy('price', 'asc');
    } elseif ($sort === 'price_desc') {
        $query->orderBy('price', 'desc');
    }

    $items = $query->get();

    return view('products.index', compact('items', 'keyword', 'sort'));
}

    public function register()
    {
        // resources/views/products/register.blade.php を表示
        return view('products.register');
    }
}
