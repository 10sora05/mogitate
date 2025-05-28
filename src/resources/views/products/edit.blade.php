@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection

@section('content')
<div class="item__content">
    <div class="edit__page">
        <a href="{{ route('products.index') }}">商品一覧</a>　>
        <span>{{ $product->name }}</span>
    </div>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="item__img">
            @if ($product->image)
            <div>
                <img src="{{ asset('fruits-img/' . $product->image) }}" alt="商品画像">
                <p id="file-name">
                    {{ $product->image }}
                </p>
                <input type="file" name="image" id="image">
            </div>
            @endif
        </div>

        <div class="item__detail">
            <div>
                <p>商品名</p>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="input-text">
            </div>

            <div>
                <p>価格</p>
                <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" class="input-text">
            </div>
            
        </div>

        <div class="item__text">
            <p>商品説明</p>
            <textarea name="description" id="description" rows="4" cols="50">{{ old('description', $product->description) }}</textarea>
        </div>
        
        <div class="button">
            <a href="{{ route('products.index') }}" class="button__return">戻る</a>

            <button type="submit" class="button__update">変更を保存</button>
        </div>
    </form>
</div>
@endsection