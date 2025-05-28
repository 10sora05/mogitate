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

    $items = $query->paginate(6);

    return view('products.index', compact('items', 'keyword', 'sort'));
}

    public function register()
    {
        // resources/views/products/register.blade.php を表示
        return view('products.register');
    }

    public function edit($id)
{
    $product = Product::findOrFail($id);
    
    return view('products.edit', compact('product'));
}

public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
    ]);

    $product->name = $request->name;
    $product->price = $request->price;
    $product->description = $request->description;

    if ($request->hasFile('image')) {
        $filename = $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('fruits-img'), $filename);
        $product->image = $filename;
    }

    $product->save();

    return redirect()->route('products.edit', $product->id)->with('success', '商品を更新しました');
}

}
