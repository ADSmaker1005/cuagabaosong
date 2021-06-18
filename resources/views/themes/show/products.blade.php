@extends('themes.app')
@section('title')
{{ $products->title }}
@endsection
@section('description')
{{ $products->description }}
@endsection
@section('keywords')
{{ $products->keywords }}
@endsection
@section('container')
<main>
    <section class="product--bread-cum">
        <a href="{{ url($products->Categories->first()->slug.'?type='.$products->Categories->first()->type) }}">{{ $products->Categories->first()->name }}</a><i class="fas fa-angle-right"></i><a href="{{ url($products->Categories->first()->slug.'/'.$products->slug) }}">{{ $products->name }}</a>
    </section>

    <section class="product--header">
        <div class="row">
            <div class="col-md-6">
                <div class="exzoom" id="exzoom">
                    <!-- Images -->
                    <div class="exzoom_img_box">
                      <ul class='exzoom_img_ul'>
                        <li><img src="{{ $products->img }}"/></li>
                        @if ($carousels != null)
                            @foreach ($carousels as  $carousel)
                                <li><img src="{{ $carousel }}"/></li>
                            @endforeach
                        @endif
                      </ul>
                    </div>
                   
                    <div class="exzoom_nav"></div>
                    <!-- Nav Buttons -->
                    <p class="exzoom_btn">
                        <a href="javascript:void(0);" class="exzoom_prev_btn"><i class="fas fa-angle-left"></i></a>
                        <a href="javascript:void(0);" class="exzoom_next_btn"><i class="fas fa-angle-right"></i></a>
                    </p>
                  </div>
            </div>
            <div class="col-md-6">
                <div class="product--header__name">
                    <span>{{ $products->name }}</span>
                </div>
                <div class="product--header__price">
                    <div class="product--header__price1"><small>đ</small><span>{{ number_format($products->oldprice) }}</span></div>
                    <div class="product--header__price2"><small>đ</small><span>{{ number_format($products->newprice) }}</span></div>
                    @if ($products->oldprice > $products->newprice)
                    <div class="product--header__pricebadge">{{ (($products->oldprice - $products->newprice)/$products->oldprice)*100  }}% giảm</div>
                    @endif
                    
                </div>
                <form id="product__form" enctype="multipart/form-data">
                    @csrf
                    @foreach ($products->OptionCategories as $categories)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="3">
                                        <div class="product__form--options__categories">
                                            {{ $categories->name }}
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories->Options as $option)
                                <tr class="product__form--options__list">
                                    <td>
                                        <div class="product__form--options__item">
                                            <input class="product__form--options__item--input" type="checkbox" value="{{$option->id}}" id="option{{$option->id}}" name="option[]">
                                            <label class="product__form--options__item--label" for="option{{$option->id}}">{{$option->name}}</label>
                                        </div>
                                    </td>
                                    <td>
                                        <span>{{ number_format($option->price) }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach
                    <div class="product--header__quality">
                        <span>Số lượng</span>
                        <input type="number" name="quality" min="1" value="1">
                    </div>
                    <div class="mt-2">
                        {!! $products->text !!}
                    </div>
                    <div class="product--connect__facebook">
                        <a href="{{ ("https://www.facebook.com/messages/t/".$themes->fanpage) }}"><i class="fab fa-facebook-messenger"></i><span>Chat facebook</span></a>
                    </div>
                    <div class="product--header__cart">
                        <button type="submit" data-id="{{ $products->id }}" id="product--header__cart--add" class="product--header__cart--add"><i class="fas fa-cart-plus"></i><span>Thêm vào giỏ hàng</span></button>
                        <button type="submit" data-id="{{ $products->id }}" id="product--header__cart--buy" class="product--header__cart--buy">Mua ngay</button>
                    </div>
                </form>
                {{-- <div class="product--header__service">
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="product--header__service--item">
                                <i class="fas fa-arrow-alt-circle-right"></i>
                                <span>7 ngày miễn phí trả hàng</span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="product--header__service--item">
                                <i class="fas fa-arrow-alt-circle-right"></i>
                                <span>7 ngày miễn phí trả hàng</span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="product--header__service--item">
                                <i class="fas fa-arrow-alt-circle-right"></i>
                                <span>7 ngày miễn phí trả hàng</span>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="product--categories">
                    <span>Danh mục: </span>
                    @foreach ($products->Categories as $category)
                        <a href="{{ url($category->slug.'?type='.$category->type) }}">{{ $category->name }}</a>
                    @endforeach 
                    
                </div>
                
            </div>
        </div>
    </section>
    <section class="product--detail">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Mô tả</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Đánh giá ({{ count($form) }})</a>
            </li>
        </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                @if ($products->infoname != "a:1:{i:0;N;}" ||$products->infotext != "a:1:{i:0;N;}")
                    <div class="product--detail-header">
                        CHI TIẾT SẢN PHẨM
                    </div>
                    <div class="product--detail-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>
                                        Thông số
                                    </th>
                                    <th>
                                        Chi tiết
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 1; $i <= min([count(unserialize ($products->infoname)),count(unserialize ($products->infotext))]); $i++)
                                    <tr>
                                        <td>{{ (unserialize($products->infoname)[$i-1]) }}</td>
                                        <td>{{ (unserialize($products->infotext)[$i-1]) }}</td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                @endif
                <div class="product--detail-header">
                    MÔ TẢ SẢN PHẨM
                </div>
                <div style="overflow: auto">
                    {!! $products->content !!}
                </div>
                <div class="fb-comments" data-href="{{ url()->current() }}" data-width="100%" data-numposts="5"></div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="product--detail-header">
                    ĐÁNH GIÁ
                </div>
                <div class="product--detail-body">
                    <div class="product--comment__list">
                        @if (count($form) > 0)
                            @foreach ($form as $item)
                                <div class="product--comment__item pb-2 mb-1">
                                    <div class="product--comment__header">
                                        <span>{{ $item->name }}</span><small>({{ $item->star }}) sao</small>
                                    </div>
                                    <div class="product--comment__text">
                                        {{ $item->content }}
                                        <small>{{ $item->created_at->diffForHumans() }}</small>
                                    </div>
                                    
                                </div>
                            @endforeach
                        @else
                            <div class="product--comment__item pb-2 mb-1">
                                <div class="product--comment__header">
                                    <span>Thông báo</span><small>(0) sao</small>
                                </div>
                                <div class="product--comment__text">
                                    Chưa có đánh giá nào.
                                </div>
                            </div>
                        @endif
                        
                        
                    </div>
                    <div class="product--comment__form">
                        <div class="product--comment__form--header">
                            Hãy là người đầu tiên nhận xét "{{ $products->name }}"
                        </div>
                        <form action="{{ route('form') }}" class="product--comment__form--input" method="POST">
                            @csrf
                            @method('POST')
                            <input type="hidden" value="{{ $products->id }}" name="product_id">
                            <div class="product--comment__form--header">
                                <h2>Đánh giá của bạn</h2>
                                <div class="product--comment__form--star">
                                    <input type="radio" name="star" value="1" id="star1">
                                    <label for="star1" >
                                        <i class="fa fa-star"></i>
                                    </label>
                                    <input type="radio" name="star" value="2" id="star2">
                                    <label for="star2" >
                                        <i class="fa fa-star"></i>
                                    </label>
                                    <input type="radio" name="star" value="3" id="star3">
                                    <label for="star3" >
                                        <i class="fa fa-star"></i>
                                    </label>
                                    <input type="radio" name="star" value="4" id="star4">
                                    <label for="star4" >
                                        <i class="fa fa-star"></i>
                                    </label>
                                    <input type="radio" name="star" value="5" id="star5">
                                    <label for="star5" >
                                        <i class="fa fa-star"></i>
                                    </label>
                                </div>
                            </div>
                            <div class="product--comment__form--content">
                                <label>Nhận xét của bạn</label>
                                <textarea rows="5" name="content"></textarea>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Tên *</label>
                                        <input name="name">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Email *</label>
                                        <input name="email" type="email">
                                    </div>
                                </div>
                                <button type="submit">GỬI ĐI</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          </div>
    </section>

    @if ($productsitem->count() > 0)
        <section class="home-stadust">
            <div class="home-stadust__header">
                <span>Gợi ý hôm nay</span>
            </div>
            <div class="home-flashsalse2--slider">
                @foreach ($productsitem as $product)
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
</main>

@endsection
@push('css')


<style>
    header{
        position: relative !important;
    }
</style>
@endpush
@push('script')

<script>
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
</script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" 
        integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" 
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.exzoom.js') }}"></script>
<script>
    $('.product--header').ready(function(){

        $("#exzoom").exzoom({

        // thumbnail nav options
        "navWidth": 60,
        "navHeight": 60,
        "navItemNum": 5,
        "navItemMargin": 7,
        "navBorder": 1,

        // autoplay
        "autoPlay": true,

        // autoplay interval in milliseconds
        "autoPlayTimeout": 2000
        
        });

    });
</script>


<script>
    $("#product--header__cart--add").on("click",function(){
        var id = $(this).attr("data-id");
        var route = "{{ route('cart.addCart',['id']) }}";
        route = route.replace('id',id);
        $("#product__form").attr('action',route).attr("method","POST");
    })
    $("#product--header__cart--buy").on("click",function(){
        var id = $(this).attr("data-id");
        var route2 = "{{ route('cart.buyNow',['id']) }}";
        route2 = route2.replace('id',id);
        $("#product__form").attr('action',route2).attr("method","POST");
    });
   
</script>
@endpush