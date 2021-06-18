@extends('themes.app')
@section('title')
{{ $posts->title }}
@endsection
@section('description')
{{ $posts->description }}
@endsection
@section('keywords')
{{ $posts->keywords }}
@endsection
@section('container')

    <main style="margin-top: 113px">
        <div class="container">
            <div class="index--service--head">
                <h3 class="service__header">
                    {{ $posts->name }}
                </h3>
                <div class="service__text">
                    {{ $posts->text }}
                </div>
                <div class="service__font">
                    {!! $themes->icon !!}
                </div>
                <hr>
            </div>
            <div class="mt-2 p-2">
                {!! $posts->content !!}
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