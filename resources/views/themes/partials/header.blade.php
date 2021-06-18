<header>
    <div class="header__top">
        <div class="header__top--container">
            <a href="/" class="header__top--logo">
                <img src="{{ $themes->logo }}">
            </a>
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
                    {{-- <li>
                        <a href="#" class="header__top--nav__right--link">
                            <i class="far fa-bell"></i>
                            <span>Thông báo</span>
                        </a>
                    </li> --}}
                     <li>
                        <a href="{{ route('contact') }}" class="header__top--nav__right--link">
                            <i class="far fa-question-circle"></i>
                            <span>Liên hệ</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="header__top--nav__right--link header__top--nav__right--borderright">
                            <span>Đăng ký đại lý</span>
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
        <div class="header__search--container">
            <a href="/" class="header__search--logo">
                <img src="{{ $themes->logo }}">
            </a>
            <div class="header__search--searchbarsection">
                <div class="header__search--searchbar">
                    <input>
                    <button><i class="fas fa-search"></i></button>
                </div>
                <span class="header__search--key">
                    @foreach ($Menucategories->sortBy('sort_id')->where('type',"1") as $index => $category)
                        @foreach ($category->childs->sortBy('sort_id') as $category)
                            <a href="{{ url($category->slug.'?type='.$category->type) }}">{{ $category->name }}</a>
                            @include('themes.partials.header-child',['category'=> $category])
                        @endforeach
                    @endforeach
                </span>
            </div>
            <a href="{{ route('cart.index') }}" class="header__search--cart">
                <i class="fas fa-shopping-cart"></i>
                <span>
                    {{ (count(Cart::content())) }}
                </span>
            </a>
        </div>
    </div>
</header>