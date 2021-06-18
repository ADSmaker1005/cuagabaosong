<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv=”content-language” content=”vi” />
    <title>Giỏ hàng</title>
    <meta name=”robots” content=”index,follow” />
    <link rel="icon" type="image/png" href="{{ $themes->favicon }}"/>
    <meta name=’revisit-after’ content=’1 days’ />
    <meta http-equiv = "Content-Type" content = "text / html; charset = utf-8" />
    <script src="https://kit.fontawesome.com/d3be5a5fe5.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css"/>
    <link rel="stylesheet" href="{{ asset('css/call-zalo.css') }}">
    <link rel="stylesheet" href="{{asset('css/call-zalo.css')}}">
    <link rel="stylesheet" href="{{asset('css/callnow.css')}}">
    <link rel="stylesheet" href="{{asset('css/fbchat.css')}}">
    <link rel="stylesheet" href="{{asset('css/menu-mobile.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <style>
        header{
            position: relative !important;
            z-index: 1;
        }
    </style>
</head>
<body>
    @include('themes.partials.header-mobile')
    <header>
        <div class="header__top">
            <div class="header__top--container">
                <div class="header__top--flex">
                    <div class="header__top--nav">
                        <div class="header__top--flex">
                            <div class="header__top--nav__left1">
                                <a href="#">Kênh người bán</a>
                            </div>
                            <div class="header__top--nav__left2">
                                <span>Tải ứng dụng</span>
                            </div>
                            <div class="header__top--nav__left3">
                                <span>Kết nối </span><a href="https://m.me/{{ $themes->fanpage }}" class="header__top--nav__left3--icon" style="color: #166FE5"><i class="fab fa-facebook"></i></a><a href="{{ $themes->tiktok }}" class="header__top--nav__left3--icon"><i class="fab fa-tiktok"></i></a><a href="{{ $themes->youtube }}" class="header__top--nav__left3--icon" style="color:red"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="header__top--space">
    
                    </div>
                    <ul class="header__top--nav__right">
                        <li>
                            <a href="#" class="header__top--nav__right--link">
                                <i class="far fa-bell"></i>
                                <span>Thông báo</span>
                            </a>
                        </li>
                         <li>
                            <a href="{{ route('contact') }}" class="header__top--nav__right--link">
                                <i class="far fa-question-circle"></i>
                                <span>Liên hệ</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="header__top--nav__right--link header__top--nav__right--borderright">
                                <span>Đăng ký</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/login') }}" class="header__top--nav__right--link">
                                <span>Đăng nhập</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="cart__header">
            <div class="container">
                <div class="cart__header--row">
                    <a href="/" class="cart__header--logo">
                        <img src="{{ $themes->logo }}">
                    </a>
                    <div class="cart__header--cart">
                        Giỏ hàng
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="cart__main">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-7">
                    <div class="cart__col1">
                        <table class="table cart__col1__table">
                            <thead>
                                <tr>
                                    <th>
                                        SẢN PHẨM
                                    </th>
                                    <th>
                                        Chức năng kèm
                                    </th>
                                    <th>
                                        GIÁ
                                    </th>
                                    <th>
                                        SỐ LƯỢNG
                                    </th>
                                    <th>
                                        TỔNG CỘNG
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach (\Cart::content() as $cart)
                                @php
                                    $sumrow = 0;
                                @endphp
                                <tr class="cart__item">
                                    <td>
                                        <div class="cart__avatar">
                                            <div class="cart__deletebtn">
                                                <a href="{{ route('cart.deleteRow',['rowId'=>$cart->rowId]) }}"><i class="far fa-times-circle"></i></a>
                                            </div>
                                            <div class="cart__img">
                                                <img src="{{ $cart->id->img }}">
                                            </div>
                                            <div class="cart__name">
                                                {{ $cart->name }}
                                            </div>
                                        </div>  
                                    </td>
                                    <td>
                                        {{-- @dump($cart->options) --}}
                                        @if ($cart->options != null)
                                            <ul>
                                                @php
                                                    $options = App\Models\ProductOption::whereIn('id',$cart->options->first() != null ? $cart->options->first() : [])->get();
                                                    $sumrow += $options->sum('price')*$cart->qty;
                                                @endphp
                                                @foreach ($options as $optitem)
                                                    <li>
                                                        {{ $optitem->name }}. <br><span class="cart__newprice" style="height: auto;display: inline-flex;"> <p>{{ number_format($optitem->price) }}</p><span>đ</span> </span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="cart__newprice"><p>{{ number_format($cart->price +$sumrow) }}</p><span>đ</span></span>
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.updateRow',$cart->rowId) }}" class="cart__qty" method="POST">
                                            @csrf
                                            @method('POST')
                                            <input type="number" name="cartqty" onchange="this.form.submit()" value="{{ $cart->qty }}">
                                        </form>
                                    </td>
                                    <td>
                                        <span class="cart__totalprice"><p>{{ number_format($cart->price*$cart->qty + $sumrow) }}</p><span>đ</span></span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4"> 
                                        <div class="cart__back">
                                            <a href="/" class="cart__back--link"><i class="fas fa-long-arrow-alt-left"></i><span>Tiếp tục xem sản phẩm</span></a>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="cart__col2">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        TỔNG SỐ LƯỢNG
                                    </th>
                                    <th>

                                    </th>
                                </tr>
                            </thead>
                                <tr>
                                    <td>
                                        Tổng cộng
                                    </td>
                                    <td>
                                        @php
                                            $sumOpt = 0;
                                            $sumCart = 0;
                                        @endphp
                                        
                                        @foreach (\Cart::content() as $cart)
                                            @if ($cart->options != null)
                                                @php
                                                    $sumrow = 0;
                                                    $options = App\Models\ProductOption::whereIn('id',$cart->options->first() != null ? $cart->options->first() : [] )->get();
                                                    $sumOpt += $options->sum('price')*$cart->qty;
                                                    $sumCart += $cart->price*$cart->qty;
                                                @endphp
                                            @endif
                                            
                                        @endforeach
                                        <div class="cart__total"><p>{{ number_format($sumCart + $sumOpt) }}</p><span>đ</span></div>
                                    </td>
                                </tr>
                                <tr>
                                    {{-- <td>
                                        Giao hàng
                                    </td> --}}
                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Tạm tính
                                    </td>
                                    <td>
                                        <div class="cart__total"><p>{{ number_format($sumCart + $sumOpt) }}</p><span>đ</span></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="cart__deletebtn">
                                            <a href="{{ route('cart.deleteAll') }}">Xóa giỏ hàng</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="cart_btn">
                                            <button id="cart__payment--btn">Mua hàng</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2">
                                        <div class="saleoff-cart">
                                            <i class="fas fa-tag"></i><b>Mã giảm giá</b>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="saleoff-code">
                                            <input placeholder="Mã ưu đãi">
                                        </div>
                                        <button class="saleoff-btn">Áp dụng mã ưu đãi</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    
    @include('themes.partials.footer')
    @include('themes.partials.call')
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    @include('themes.cart.modal')
    <script>
        $("#cart__payment--btn").on("click",function(){
            $("#cart__payment--modal").modal("show");
      
            route ="{{ route('cart.storeCart') }}";
            $("#cart__payment--form").attr("action",route);
            $(".select_province").on("change",function(){
                var province = $(this).val();
                var route = "{{ route('ajax.AjaxGetDistrictByprovice',['id']) }}";
                route = route.replace('id',province);
                $.ajax({
                    url: route,
                    method: 'POST',
                    data:{
                            "_token": "{{ csrf_token() }}",
                    },
                    success: function(data){
                        $(".select_district").html('<option>Chọn</option>');
                        $.each(data,function(index, value){
                            $(".select_district").append('<option value="'+value.id+'">'+value.name+'</option>')
                        });
                        $(".select_district").on("change",function(){
                        var district = $(this).val();
                        var ward_route="{{ route('ajax.AjaxGetWardByProvinceDistrict') }}";
                        var street_route = "{{ route('ajax.AjaxGetStreetByProvinceDistrict') }}";
      
                        $.ajax({
                          url:ward_route,
                          method: 'POST',
                          data:{
                            "_token": "{{ csrf_token() }}",
                            province: province,
                            district: district
                          },
                          success: function(data){
                            console.log(data);
                            $(".select_ward").html('<option>Chọn</option>');
                            $.each(data,function(index, value){
                                $(".select_ward").append('<option value="'+value.id+'">'+value._prefix+': '+value._name+'</option>')
                            });
                          }
                        });
      
                        $.ajax({
                          url:street_route,
                          method: 'POST',
                          data:{
                            "_token": "{{ csrf_token() }}",
                            province: province,
                            district: district
                          },
                          success: function(data){
                            $(".select_street").html('<option>Chọn</option>');
                            $.each(data,function(index, value){
                                $(".select_street").append('<option value="'+value.id+'">'+value._prefix+': '+value._name+'</option>')
                            });
                          }
                        });
                    })
                    }
                })
                
            });
        }) 
      </script>
</body>
</html>