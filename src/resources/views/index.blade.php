@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="index__content">

    <div class="index__heading">
        <h2>商品一覧</h2>
    </div>

    <div class="index__search_form">
        <ul>
            <li><a href="#">商品名</a></li>
            <li><a href="#">価格</a></li>
        </ul>
    </div>

    <div class="index__items">
        <div class="flex">
            @foreach ($items as $item)
            <div class="item__content">
                <div class="item">
                    <div class="item__img">
                        <img src="{{ asset('fruits-img/' . $item->image) }}" alt="商品画像">
                    </div>
                    <div class="card__content">
                        <form class="update-form">
                            <div class="update-form__item">
                                <p class="update-form__item-name">{{ $item->name }}</p>
                            </div>
                            <div class="update-form__item">
                                <p class="update-form__item-price">￥{{ $item->price }}</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection