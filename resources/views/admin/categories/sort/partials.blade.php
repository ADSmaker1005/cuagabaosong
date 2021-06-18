<ol class="pl-4">
    @if($category->childs->count() > 0)
        @foreach ($category->childs->sortBy('sort_id') as $category)
            <li>
                <div class="input-group">
                    <label class="form-control">{{ $category->sort_id }}---{{ $category->name }}</label>
                    <div class="input-group-append">
                        <select class="input-group-text" onchange="location = '/admin/control/categories/update/{{ $category->id }}?parent_id='+this.value;">
                            <option>---Chọn---</option>
                            @foreach ($menu->where('parent_id',null) as $item)
                                @if ($item->id != $category->id)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif
                            @endforeach
                            <option value="">Menu chính</option>
                        </select>
                    </div>
                </div>
            </li>
            @include('admin.categories.sort.partials',['category'=>$category])
        @endforeach
    @endif
</ol>

