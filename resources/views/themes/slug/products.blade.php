@extends('themes.app')
@section('title')
{{ $productCategory->title }}
@endsection
@section('description')
{{ $productCategory->description }}
@endsection
@section('keywords')
{{ $productCategory->keywords }}
@endsection
@section('container')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="slug__categories">
                        <h2>Danh mục sản phẩm</h2>
                        <div class="row">
                            @foreach ($categories->where('type',1) as $category)
                                @foreach ($category->childs->sortBy('sort_id') as $category)
                                    <div class="col-md-3">
                                        <a href="{{ url($category->slug.'?type='.$category->type.'&locate='.$category->locate) }}">
                                            {{ $category->name }}
                                        </a>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                        <h3 class="service__header">
                            {{ $productCategory->name }}
                        </h3>
                        <div class="service__text">
                            {{ $productCategory->text }}
                        </div>
                        <div class="service__font">
                            {!! $themes->icon !!}
                        </div>
                        <hr>
                        <div class="row">
                            @foreach ($productCategory->products as $item)
                                    <div class="col-6 col-sm-6 col-md-3">
                                        <a href="{{ url($productCategory->slug.'/'.$item->slug) }}" class="home-flashsalse2--item">
                                            @if ($item->newprice < $item->oldprice)
                                            <div class="home-flashsalse2--item__badge">
                                                <span class="home-flashsalse2--item__badge--sale">{{ (($item->oldprice - $item->newprice)/$item->oldprice)*100  }}%</span>
                                                <span class="home-flashsalse2--item__badge--sale2">giảm</span>
                                            </div>
                                            @endif
                                            <div class="home-flashsalse2--item__img">
                                                @if ($item->banner != null)
                                                    <img class="home-flashsalse2--item__img-1" src="{{ $item->banner }}">
                                                @endif
                                                <img class="home-flashsalse2--item__img-2" src="{{ $item->img }}">
                                            </div>
                                            <div class="news__item--header">
                                                {{ $item->name }}
                                            </div>
                                            <div class="home-stadust__item__price">
                                                <div class="home-stadust__item__price2">
                                                    <small>đ</small>
                                                    <span>{{ number_format($item->newprice) }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                            @endforeach
                        </div>
                </div>
            </div>
        </div>

    </main>
@endsection
@push('css')
<style>
    header{
        position: relative !important;
    }
</style>
@endpush