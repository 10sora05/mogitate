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
                <img src="{{ asset('storage/fruits-img/' . $product->image) }}" alt="商品画像">
                <p id="file-name">
                    {{ $product->image }}
                </p>
                <input type="file" name="image" id="image">
                @error('image')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>
            @endif
        </div>

        <div class="item__detail">
            <div>
                <p>商品名</p>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="input-text">
                @error('name')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <p>値段</p>
                <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" class="input-text">
                @error('price')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="season-options">
                <p>季節</p>
                @foreach($seasons as $season)
                    <label>
                        <input type="checkbox" name="season_ids[]" class="input__season" value="{{ $season->id }}"
                            {{ in_array($season->id, $selectedSeasons) ? 'checked' : '' }}>
                        {{ $season->name }}
                    </label>
                @endforeach
                @error('season_ids')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="item__text">
            <p>商品説明</p>
            <textarea name="description" id="description" rows="4" cols="50">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <div style="color: red;">{{ $message }}</div>
            @enderror

        </div>
        
        <div class="button">
            <div class="button-center">
                <a href="{{ route('products.index') }}" class="button__return">戻る</a>

                <button type="submit" class="button__update">変更を保存</button>
            </div>
    </form>

            <div class="button-rigth">
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button__delete">
                        <img src="{{ asset('fruits-img/delete-icon.png') }}" alt="削除" class="delete-icon">
                    </button>
                </form>
            </div>
        </div>
</div>
@endsection