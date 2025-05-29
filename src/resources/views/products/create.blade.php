@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')

<div class="register__detail">

    <h2>商品登録</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div>
            <p>商品名<span>必須</span></p>
            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="商品名を入力" class="input-text">
            @error('name')
            <div style="color: red;">{{ $message }}</div>
            @enderror        </div>

        <div>
            <p>値段<span>必須</span></p>
            <input type="number" name="price" id="price" value="{{ old('price') }}" placeholder="値段を入力" class="input-text">
            @error('price')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div class="item__img">
            <p>商品画像<span>必須</span></p>
            <img id="preview" src="" style="">
            <input type="file" name="image" id="image">
            @error('image')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div class="season-options">
            <p>季節<span>必須</span></p>
            @foreach($seasons as $season)
            <label>
                <input type="checkbox" name="season_ids[]" class="input__season" value="{{ $season->id }}"
                    {{ (is_array(old('season_ids')) && in_array($season->id, old('season_ids'))) ? 'checked' : '' }}>
                {{ $season->name }}
            </label>
            @endforeach
            @error('season_ids')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div class="item__text">
            <p>商品説明<span>必須</span></p>
            <textarea name="description" id="description" rows="4" cols="50" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            @error('description')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div class="button">
            <div class="button-center">
                <a href="{{ route('products.index') }}" class="button__return">戻る</a>

                <button type="submit" class="button__update">登録</button>
            </div>
        </div>
    </form>
</div>
<script>
    document.getElementById('image').addEventListener('change', function (event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview');

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
            preview.style.display = 'none';
        }
    });
</script>

@endsection
