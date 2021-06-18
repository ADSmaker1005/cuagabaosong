@extends('themes.app')
@section('title')
{{ $themes->title }}
@endsection
@section('description')
{{ $themes->description }}
@endsection
@section('keywords')
{{ $themes->keywords }}
@endsection
@section('container')
<main>
    @if ($banner->where('locate','1')->count() > 0)
    <section class="home-banner">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-sm-12 col-md-8">
                    <div id="home-bannerIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($banner->sortBy('sort_by')->where('locate','1') as $index => $item)
                                <button type="button" data-bs-target="#home-bannerIndicators" data-bs-slide-to="{{ $i }}" class="home-banner__dots {{ $loop->first ? 'active' : '' }}" {{ $loop->first ? 'aria-current="true"' : '' }} aria-label="{{ $item->name }}"></button>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                          
                        </div>
                        <div class="carousel-inner">
                            @foreach ($banner->sortBy('sort_by')->where('locate','1') as $item)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <div class="home-banner__item">
                                        <a href="{{ $item->link }}">
                                            <img src="{{ $item->images }}" class="d-block w-100" alt="{{ $item->name }}">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev home-banner__prev" type="button" data-bs-target="#home-bannerIndicators"  data-bs-slide="prev">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="carousel-control-next home-banner__next" type="button" data-bs-target="#home-bannerIndicators"  data-bs-slide="next">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    @if ($banner->where('locate','2')->count() > 0)
                        <div class="home-banner__colright">
                            @foreach ($banner->sortBy('sort_by')->where('locate','2')->random()->limit(2)->get() as $item)
                            <a href="{{ $item->link }}">
                                <img src="{{ $item->images }}">
                            </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
    </section>
    @endif
    
    @if ($categories->where('type','0')->where('locate','1')->count() > 0)
        <section class="home-categories">
            <div class="home-categories__container">
                @foreach ($categories->where('type','0')->where('locate','1')->sortBy('sort_id') as $item)
                    <a href="{{ url($item->slug != null ? url($item->slug.'?type='.$item->type) :'') }}" title="{{ $item->name }}" class="home-categories__item">
                        <img src="{{ $item->image }}">
                        <span>{{ $item->name }}</span>
                    </a>
                @endforeach
            </div>
            
        </section>
    @endif
    
    <section class="home-event">
        @foreach ($banner->sortBy('sort_by')->where('locate','3') as $item)
        <a href="{{ $item->link }}">
            <img src="{{ $item->images }}">
        </a>
        @endforeach
    </section>
    @if (count($posts) > 0)
    <section class="home-service">
        <div class="container">
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-12 col-sm-6 col-md-3 mb-4">
                        <a href="{{ $post->Categories->first() != null ? url($post->Categories->first()->slug.'/'.$post->slug) : "#"}}" class="home-service__item">
                            <div class="home-service__item--icon">
                                <img src="{{ $post->img }}" alt="">
                            </div>
                            <div class="home-service__item--name">
                                {{ $post->name }}
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    
    @if ($categories->where('type','1')->count() > 0)
        <section class="home-categories2">
            <label class="home-categories2__header">DANH MỤC</label>
            <div class="home-categories2__list">
                <div class="home-categories2__list--slick">
                    @foreach ($categories->where('type','1')->where("showindex","1") as $item)
                        <div>
                            <a href="{{ url($item->slug != null ? $item->slug.'?type='.$item->type :'') }}" class="home-categories2__list__item">
                                <img src="{{ $item->image }}">
                                <span>{{ $item->name }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="home-flashsale">
        <div class="home-flashsale__colleft">
            <a href="{{ route('flashSale',['type' => "flashsale"]) }}" class="home-flashsale--img">
                <img src="{{ asset('images/test/flash.png') }}">
            </a>
            <div class="home-flashsale--timer">
                <div class="home-flashsale--timer__container">
                    <div class="home-flashsale--timer__container--number">
                        0
                    </div>
                    <div class="home-flashsale--timer__container--number">
                        9
                    </div>
                </div>
            </div>
            <div class="home-flashsale--timer">
                <div class="home-flashsale--timer__container">
                    <div class="home-flashsale--timer__container--number">
                        0
                    </div>
                    <div class="home-flashsale--timer__container--number">
                        9
                    </div>
                </div>
            </div>
            <div class="home-flashsale--timer">
                <div class="home-flashsale--timer__container">
                    <div class="home-flashsale--timer__container--number">
                        0
                    </div>
                    <div class="home-flashsale--timer__container--number">
                        9
                    </div>
                </div>
            </div>
        </div>
        <div class="home-flashsale__space">

        </div>
        <div class="home-flashsale__colright">
            <a href="{{ route('flashSale',['type' => "flashsale"]) }}">
                Xem tất cả >
            </a>
        </div>
    </section>
    @if ($products->where('showindex','1')->count() > 0)
       
            <section class="home-flashsalse2">
                <div class="home-flashsalse2--slider">
                    @foreach ($products->where('showindex','1') as $product)
                    <div class="home-flashsalse2--slideritem">
                        <a href="{{ url($product->Categories->first()->slug.'/'.$product->slug) }}" class="home-flashsalse2--item">
                            @if ($product->newprice < $product->oldprice)
                            <div class="home-flashsalse2--item__badge">
                                <span class="home-flashsalse2--item__badge--sale">{{ (($product->oldprice - $product->newprice)/$product->oldprice)*100  }}%</span>
                                <span class="home-flashsalse2--item__badge--sale2">giảm</span>
                            </div>
                            @endif
                            <div class="home-flashsalse2--item__img">
                                @if ($product->banner != null)
                                    <img class="home-flashsalse2--item__img-1" src="{{ $product->banner }}">
                                @endif
                                <img class="home-flashsalse2--item__img-2" src="{{ $product->img }}">
                            </div>
                            <div>
                                {{ $product->name }}
                            </div>
                            <div class="home-stadust__item__price">
                                <div class="home-stadust__item__price2">
                                    <small>đ</small>
                                    <span>{{ number_format($product->newprice) }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </section>
        
    @endif
    
    {{-- <section class="home-shinnybanner">
        <div class="row">
            <div class="col-md-4">
                <a href="#" class="home-shinnybanner--img">
                    <img src="{{ asset('images/test/shinny-banner.png') }}">
                </a>
            </div>
            <div class="col-md-4">
                <a href="#" class="home-shinnybanner--img">
                    <img src="{{ asset('images/test/shinny-banner.png') }}">
                </a>
            </div>
            <div class="col-md-4">
                <a href="#" class="home-shinnybanner--img">
                    <img src="{{ asset('images/test/shinny-banner.png') }}">
                </a>
            </div>
        </div>
    </section> --}}
    @if ($categories->where('type','1')->where('locate','3')->count() > 0)
        @foreach ($categories->where('type','1')->where('locate','3') as $category)
            <section class="header-mall">
                <div class="header-mall__title">
                    <a href="{{ url($category->slug.'?type='.$category->type) }}">{{ $category->name }}</a>
                    <ul class="header-mall__title--list">
                        <li  class="header-mall__title--list__link">
                            <i class="fas fa-arrow-alt-circle-right"></i>
                            <span>7 Ngày Miễn Phí Trả Hàng</span>
                        </li>
                    </ul>
                    <div class="header-mall__title--space">

                    </div>
                    <a href="{{ url($category->slug.'?type='.$category->type) }}" class="header-mall__title--more">Xem tất cả <i class="fas fa-arrow-alt-circle-right"></i></a>
                </div>
            </section>
            <section class="home-sale">
                    <div class="container">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <div id="home-saleIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#home-saleIndicators" data-bs-slide-to="0" class="home-sale__dots active" aria-current="true" aria-label="{{ $category->name }}"></button>
                                    </div>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="home-sale__item">
                                                <a href="{{ url($category->slug.'?type='.$category->type) }}" title="{{ $category->name }}">
                                                    <img src="{{ $category->image }}" class="d-block w-100" alt="{{ $category->name }}">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                @if ($category->products != null)
                                    <div class="home-flashsalse3--slider">
                                        @foreach ($category->products->chunk(2) as $chunk)
                                            <div class="home-sale--listitem">
                                                @foreach ($chunk as $product)
                                                    <a href="{{ url($category->slug.'/'.$product->slug) }}" class="home-flashsalse2--item">
                                                        @if ($product->newprice < $product->oldprice)
                                                            <div class="home-flashsalse2--item__badge">
                                                                <span class="home-flashsalse2--item__badge--sale">{{ (($product->oldprice - $product->newprice)/$product->oldprice)*100  }}%</span>
                                                                <span class="home-flashsalse2--item__badge--sale2">giảm</span>
                                                            </div>
                                                        @endif
                                                        <div class="home-flashsalse2--item__img">
                                                            @if ($product->banner != null)
                                                                <img class="home-flashsalse2--item__img-1" src="{{ $product->banner }}">
                                                            @endif
                                                            <img class="home-flashsalse2--item__img-2" src="{{ $product->img }}">
                                                        </div>
                                                        <div class="home-stadust__item__price">
                                                            <div class="home-stadust__item__price2">
                                                                <small>đ</small>
                                                                <span>{{ number_format($product->newprice) }}</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div> 
                                @endif
                            </div>
                        </div>
                    </div>
            </section>
        @endforeach
    @endif
    
    @if ($products->where('showindex','1')->count() > 0)
        <section class="home-stadust">
            <div class="home-stadust__header">
                <span>Gợi ý hôm nay</span>
            </div>
            <div class="home-stadust__list">
                @foreach ($products->where('showindex','1') as $product)
                    <div class="home-stadust__item">
                        <a href="{{ url($product->Categories->first()->slug.'/'.$product->slug) }}" >
                            @if ($product->oldprice > $product->newprice)
                                <div class="home-stadust__item__badge">
                                    <span class="home-stadust__item__badge--sale">{{ (($product->oldprice - $product->newprice)/$product->oldprice)*100  }}%</span>
                                    <span class="home-stadust__item__badge--sale2">giảm</span>
                                </div>
                            @endif
                            <div class="home-stadust__item__img">
                                @if ($product->banner != null)
                                    <img class="home-stadust__item__img-1" src="{{ $product->banner }}">
                                @endif
                                <img class="home-stadust__item__img-2" src="{{ $product->img }}">
                            </div>
                            <div class="home-stadust__item__name">
                                {{ $product->name }}
                            </div>
                                <div class="home-stadust__item__sale">
                                    @if ($product->oldprice > $product->newprice)
                                        <span>Giảm {{ $product->oldprice - $product->newprice }}k</span>
                                    @endif
                                </div>
                            <div class="home-stadust__item__price">
                                <div class="home-stadust__item__price1">
                                    <small>đ</small>
                                    <span>{{ number_format($product->oldprice) }}</span>
                                </div>
                                <div class="home-stadust__item__price2">
                                    <small>đ</small>
                                    <span>{{ number_format($product->newprice) }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
    
</main>
@endsection
@push('script')
<script>
    $('.home-categories2__list--slick').slick({
    infinite: false,
    slidesToShow: 10,
    responsive: [
    {
        breakpoint: 1000,
        settings: {
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 6
        }
        },
        {
        breakpoint: 768,
        settings: {
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 2
        }
        },
        {
        breakpoint: 480,
        settings: {
            arrows: false,
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 2
        }
        }
    ],
    
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    prevArrow:'<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
    nextArrow:'<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>'
    });
    $('.home-flashsalse2--slider').slick({
    infinite: false,
    slidesToShow: 6,
    responsive: [
    {
        breakpoint: 1000,
        settings: {
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 4
        }
        },
        {
        breakpoint: 768,
        settings: {
            arrows: false,
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 2
        }
        },
        {
        breakpoint: 480,
        settings: {
            arrows: false,
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 1
        }
        }
    ],
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    prevArrow:'<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
    nextArrow:'<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>'
    });
    $('.home-flashsalse3--slider').slick({
    infinite: false,
    slidesToShow: 4,
    responsive: [
    {
        breakpoint: 1000,
        settings: {
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 3
        }
        },
        {
        breakpoint: 768,
        settings: {
            arrows: false,
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 2
        }
        },
        {
        breakpoint: 480,
        settings: {
            arrows: false,
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 1
        }
        }
    ],
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    prevArrow:'<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
    nextArrow:'<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>'
    });
</script>
@endpush