<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\StoreProductRequest;

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

    public function edit($id)
    {
    $product = Product::findOrFail($id);
    $seasons = Season::all(); // 季節一覧

    // 関連付けられている季節ID（配列）
    $selectedSeasons = $product->seasons->pluck('id')->toArray();

    return view('products.edit', compact('product', 'seasons', 'selectedSeasons'));
    }

    public function update(UpdateProductRequest $request, $id){
    $product = Product::findOrFail($id);

    $product->seasons()->sync($request->input('season_ids', []));

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

    public function destroy($id)
    {
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect()->route('products.index')->with('success', '商品を削除しました');
    }

    public function create()
    {
    $seasons = Season::all();
    return view('products.create', compact('seasons'));
    }

    public function store(StoreProductRequest $request){
    $product = new Product();
    $product->name = $request->name;
    $product->price = $request->price;
    $product->description = $request->description;

    if ($request->hasFile('image')) {
        $filename = $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('fruits-img'), $filename);
        $product->image = $filename;
    }

    $product->save();
    $product->seasons()->sync($request->input('season_ids', []));

    return redirect()->route('products.index')->with('success', '商品を登録しました');
    }

}
