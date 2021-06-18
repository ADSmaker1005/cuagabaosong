@extends('themes.app')
@section('title')
{{ $postCategories != null ? $postCategories->title : '' }}
@endsection
@section('description')
{{ $postCategories != null ? $postCategories->description : '' }}
@endsection
@section('keywords')
{{ $postCategories != null ? $postCategories->keywords : '' }}
@endsection
@section('container')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="slug__categories">
                        <h2>Danh mục bài viết</h2>
                        @foreach ($categories->where('type',0) as $category)
                            @foreach ($category->childs->sortBy('sort_id') as $category)
                                <a href="{{ url($category->slug.'?type='.$category->type.'&locate='.$category->locate) }}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        @endforeach
                    </div>
                </div>
                <div class="col-md-8">
                        <h3 class="service__header">
                            {{ $postCategories->name }}
                        </h3>
                        <div class="service__text">
                            {{ $postCategories->text }}
                        </div>
                        <div class="service__font">
                            {!! $themes->icon !!}
                        </div>
                        <hr>
                        <div class="row">
                            @foreach ($postCategories->posts as $item)
                                    <div class="col-sm-6 col-md-6">
                                        <a href="{{ url($postCategories->slug.'/'.$item->slug) }}" class="news__item">
                                            <div class="news__item--img">
                                                <img class="w-100" src="{{ $item->img }}" alt="">
                                            </div>
                                            <h3 class="news__item--header">
                                                {{ $item->name }}
                                            </h3>
                                            <div class="news__item--text">
                                                {{ $item->text }}
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