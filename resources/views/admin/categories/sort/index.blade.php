<x-app-layout>
    <x-slot name="header">
        {{ __('Sắp xếp danh mục') }}
    </x-slot>

    <ul>
        @foreach ($categories->sortBy('sort_id') as $index => $category)
            <li>
                <div class="input-group">
                    <label class="form-control"><b>{{ $category->sort_id }}---{{ $category->name }}</b></label>
                    <div class="input-group-append">
                        <select class="input-group-text" onchange="location = '/admin/control/categories/update/{{ $category->id }}?parent_id='+this.value;">
                            <option>---Chọn---</option>
                            @foreach ($menu as $item)
                                @if ($item->id != $category->id)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                @if($category->childs->count() > 0)
                <ol class="pl-4">
                    @foreach ($category->childs->sortBy('sort_id') as $category)
                        <li>
                            <div class="input-group">
                                <label class="form-control">{{ $category->sort_id }}---{{ $category->name }}</label>
                                <div class="input-group-append">
                                    <select class="input-group-text" onchange="location = '/admin/control/categories/update/{{ $category->id }}?parent_id='+this.value;">
                                        <option>---Chọn---</option>
                                        <option value="">Về trang chủ</option>
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
                </ol>

                @endif
           </li>
        @endforeach
    </ul>

    @push('css')

    @endpush
    @push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
    </script>
    @endpush
</x-app-layout>
