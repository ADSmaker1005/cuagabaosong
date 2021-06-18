@if ($category->childs->count() > 0)
@foreach ($category->childs->sortBy('sort_id')->where('type','1')->where("showindex","1") as $category)
<a href="{{ url($category->slug.'?type='.$category->type) }}">{{ $category->name }}</a>
@include('themes.partials.header-child',['category'=> $category])
@endforeach

@endif