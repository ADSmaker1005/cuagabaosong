<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv=”content-language” content=”vi” />
    <title>@yield('title')</title>
    <meta name=”robots” content=”index,follow” />
    <link rel="icon" type="image/png" href="{{ $themes->favicon }}"/>
    <meta name=’revisit-after’ content=’1 days’ />
    <meta http-equiv = "Content-Type" content = "text / html; charset = utf-8" />
    <meta name="description" content="@yield('description'){{ $themes->description }}"/>
    <meta name="keywords" content="@yield('keywords'){{ $themes->keywords }}"/>
    <link rel="canonical" href="{{ url()->current() }}" />
    <script src="https://kit.fontawesome.com/d3be5a5fe5.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css"/>
    <link rel="stylesheet" href="{{ asset('css/call-zalo.css') }}">
    <link rel="stylesheet" href="{{asset('css/call-zalo.css')}}">
    <link rel="stylesheet" href="{{asset('css/callnow.css')}}">
    <link rel="stylesheet" href="{{asset('css/fbchat.css')}}">
    <link rel="stylesheet" href="{{asset('css/menu-mobile.css')}}">
    <link rel="stylesheet" href="{{asset('css/cart-mobile.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <link rel="stylesheet" href="{{ asset('css/jquery.exzoom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <script>
        {!! $themes->css !!}
    </script>
    @stack('css')
</head>
<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0&appId=603533476924351&autoLogAppEvents=1" nonce="JO1odWPP"></script>
    <div style="position: fixed;right:0;top:0;width:0;height:0">
        {!! $themes->headtag !!}
    </div>
    @include('themes.partials.header')
    @include('themes.partials.header-mobile')
    @include('themes.partials.cart-mobile')
    @include('themes.cart.modal')
    @yield('container')
    @include('themes.partials.footer')
    @include('themes.partials.call')
    @include('admin.error')
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script  type="text/javascript">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    
    <script src="https://kit.fontawesome.com/d3be5a5fe5.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    
    @stack('script')
</body>
{!! $themes->schema !!}
</html>
