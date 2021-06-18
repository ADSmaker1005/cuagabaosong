<div class="nav__mobile">
    <input type="checkbox" id="nav__mobile__button__checkbox">
    <label id="nav__mobile__button__open" class="nav__mobile__button__open nav__mobile__button__icon"
        for="nav__mobile__button__checkbox">
        <i class="fas fa-align-justify"></i>
    </label>
    <nav class="nav__mobile__container">

        <div class="nav__mobile__item">
            <label class="nav__mobile__button__close nav__mobile__button__icon"
                for="nav__mobile__button__checkbox">
                <i class="fas fa-angle-left"></i>
            </label>
            <a href="/" class="nav__mobile__item--logo">
                <img src="{{ $themes->logo }}">
            </a>
            <a class="nav__mobile__item__menu">
                <div class="header__search--searchbar ">
                    <input>
                    <button><i class="fas fa-search" style="color: black !important"></i></button>
                </div>
            </a>
            
            <a href="tel:{{ $themes->hotline }}" class="nav__mobile__item__menu">
                <i class="fas fa-phone-square-alt" style="font-size: 22px;line-height:33px"></i>
                <span style="font-size: 22px;color:red;letter-spacing: 1.5px;">{{ $themes->hotline }}</span>
            </a>
            <a href="/" class="nav__mobile__item__menu">
                <i class="fas fa-home"></i>
                <span>Trang chủ</span>
            </a>
            @foreach ($Menucategories->sortBy('sort_id') as $index => $category)
                <a href="{{ url($category->slug.'?type='.$category->type.'&locate='.$category->locate) }}" class="nav__mobile__item__menu">
                    <span>{{ $category->name }}</span>
                    @if($category->childs->count() > 0)
                        <i class="fas fa-chevron-down"></i>
                    @endif
                </a>
                <div class="nav__mobile__item__menu--sub">
                    @foreach ($category->childs->sortBy('sort_id') as $category)
                        <a href="{{ url($category->slug.'?type='.$category->type.'&locate='.$category->locate) }}" class="indexcategory__categorylist--item">
                            <label for="indexcategory__categorylist--item" style="font-weight: bold">
                                {{ $category->name }}
                            </label>
                        </a>
                        @include('themes.partials.header-mobile-child',['category'=> $category])
                    @endforeach
                </div>
            @endforeach

                <a href="{{ route('contact') }}" class="nav__mobile__item__menu">
                    <span>Liên hệ</span>
                </a>
        </div>
    </nav>
</div>
