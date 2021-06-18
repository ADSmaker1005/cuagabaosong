@extends('themes.app')
@section('title')
Flashsale
@endsection
@section('description')
Flashsale
@endsection
@section('keywords')
Flashsale
@endsection
@section('container')
    <main class="mt-3 mb-5">
        <div class="container">
            <div class="row">
                @foreach ($products as $product)
                        <div class="col-sm-6 col-md-3">
                            <a href="{{ url($product->Categories->first()->slug.'/'.$product->slug) }}" class="news__item">
                                <div class="news__item--img">
                                    <img class="w-100 h-100" src="{{ asset($product->img) }}" alt="">
                                </div>
                                <h3 class="news__item--header">
                                    {{ $product->name }}
                                </h3>
                                <div class="news__item--text">
                                    {{ $product->text }}
                                </div>
                            </a>
                        </div>
                @endforeach
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