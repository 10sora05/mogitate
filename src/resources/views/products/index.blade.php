@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="index__content">

    <div class="index__heading">
        <div class="index__h2">
            <h2>商品一覧</h2>
        </div>

        <div class="index__register">
            <span class="register"><a class="register" href="{{ route('products.register') }}">+ 商品を追加</a></span>
        </div>
    </div>

    <div class="index__search_form">
        <form action="{{ route('products.index') }}" method="GET">
            <input type="text" name="keyword" value="{{ old('keyword', $keyword ?? '') }}" placeholder="商品名で検索" class="search_form">
            <button type="submit" class="search_button">検索</button>

            <div style="margin-top: 10px;">
                <select name="sort" id="sort" onchange="this.form.submit()" class="search_form">
                    <option value="">-- 並び替えを選択 --</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>価格が低い順</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>価格が高い順</option>
                </select>
            </div>
        </form>

        @if(request('sort'))
        <div class="sort-tag">
            <span class="sort-tag__label">
                @if(request('sort') === 'price_asc') 価格が低い順
                @elseif(request('sort') === 'price_desc') 価格が高い順
                @endif
                <a href="{{ route('products.index', array_merge(request()->except('sort'))) }}" class="sort-tag__reset">×</a>
            </span>
        </div>
        @endif

    </div>

    <div class="index__items">
        <div class="flex">
            @foreach ($items as $item)
            <div class="item__content">
                <div class="item">
                    <div class="item__img">
                        <a href="{{ route('products.edit', $item->id) }}">
                            <img src="{{ asset('storage/fruits-img/' . $item->image) }}" alt="商品画像">
                        </a>
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

    <div class="pagination">
        {{-- 前のページ --}}
        @if ($items->currentPage() > 1)
        <a href="{{ $items->previousPageUrl() }}" class="pagination__a">&lt;</a>
        @else
        <span class="pagination__span">&lt;</span>
        @endif

        {{-- 番号リンク --}}
        @for ($i = 1; $i <= $items->lastPage(); $i++)
            @if ($i == $items->currentPage())
            <span class="pagination__number">{{ $i }}</span>
            @else
            <a href="{{ $items->url($i) }}" class="pagination__a">{{ $i }}</a>
            @endif
            @endfor

            {{-- 次のページ --}}
            @if ($items->hasMorePages())
            <a href="{{ $items->nextPageUrl() }}" class="pagination__a">&gt;</a>
            @else
            <span class="pagination__span">&gt;</span>
            @endif
    </div>

</div>
@endsection