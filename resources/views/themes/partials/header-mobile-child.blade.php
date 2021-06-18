<div class="nav__mobile__item__menu--sub">
    @if($category->childs->count() > 0)
    @foreach ($category->childs->sortBy('sort_id') as $category)
            <a href="{{ url($category->slug.'?type='.$category->type.'&locate='.$category->locate) }}" class="indexcategory__categorylist--item">
                <label for="indexcategory__categorylist--item">
                    {{ $category->name }}
                </label>
            </a>
            @include('themes.partials.header-mobile-child',['category'=> $category])
        @endforeach
    @endif
</div>
