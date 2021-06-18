<x-app-layout>
    <x-slot name="header">
        {{ __('Danh mục') }}
    </x-slot>
    <div class="text-center">
        <!-- Large modal -->
        <button type="button" class="btn btn-danger waves-effect waves-light" id="create_categories_btn">Thêm categories</button>
    </div>
    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
            <th style="width: 5%">Thứ tự</th>
            <th>Tên danh mục</th>
            <th>Icon</th>
            <th style="width: 10%">hình ảnh</th>
            <th>Loại danh mục</th>
            <th>Vị trí</th>
            <th style="width: 5%">Xóa</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td><a href="#" class="inline-text" data-pk="{{ $category->id }}" data-name="sort_id" data-type="number" data-title="Enter sort number">{{ $category->sort_id }}</a></td>
                    <td>
                        {{ $category->name }}<br>
                        {{ $category->slug }}
                    </td>
                    <td>
                        {!! $category->icon !!}
                    </td>
                    <td>
                        <img class="block w-100" src="{{ $category->image }}">
                    </td>
                    <td>
                        <form action="{{ route('admin.categories.update',$category->id) }}" method="POST">
                            @csrf
                            @method('POST')
                            <select class="formcontrol" onchange="this.form.submit()" name="type">
                                <option value="0" {{ ($category->type == '0') ? 'selected' : '' }}>
                                    Bài viết
                                </option>
                                <option value="1" {{ ($category->type == '1') ? 'selected' : '' }}>
                                    Sản phẩm
                                </option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('admin.categories.update',$category->id) }}" method="POST">
                            @csrf
                            @method('POST')
                            <select class="formcontrol" onchange="this.form.submit()" name="locate">
                                <option value="0" {{ ($category->locate == '0') ? 'selected' : '' }}>
                                    --- Chọn ---
                                </option>
                                <option value="1" {{ ($category->locate == '1') ? 'selected' : '' }}>
                                    Deal sốc
                                </option>
                                <option value="2" {{ ($category->locate == '2') ? 'selected' : '' }}>
                                    Danh mục
                                </option>
                                <option value="3" {{ ($category->locate == '3') ? 'selected' : '' }}>
                                    Danh mục kèm sản phẩm
                                </option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <button type="button" class="btn btn-warning waves-effect waves-light edit_categories_btn" data-id="{{ $category->id }}"><i class="fas fa-cogs"></i></button>
                        <form action="{{ route('admin.categories.destroy',$category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-xs btn-danger"><i class="ion-trash-b"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <!--  Modal content for the above example -->
    @extends('admin.categories.modal')
    @push('scripts')
        <script>
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $(document).on("click",'#create_categories_btn',function(){
                $("input[name='title']").val('');
                $("input[name='description']").val('');
                $("input[name='keywords']").val('');
                $("input[name='sort_id']").val('');
                $("select[name='type']").val('');
                $("input[name='name']").val('');
                $("input[name='slug']").val('');
                $("select[name='locate']").val('');
                $("input[name='icon']").val('');
                $("texarea[name='text']").val('');
                $("input[name='image']").val('');
                $('#lfm').attr('src',"{{ asset('images/blank.png') }}");
                $('#categories_modal').modal("toggle");
                $('#form_categories').attr('action',"{{ route('admin.categories.store') }}").attr('method','post');
            })
            $('#datatable').on("click",".edit_categories_btn",function(){
                var id = $(this).data('id');
                $('#categories_modal').modal("toggle");
                var route = "{{ route('admin.categories.update',['categories_id']) }}";
                route = route.replace('categories_id',id);

                var get_categories = "{{ route('admin.categories.ajax',['categories_id']) }}";
                get_categories = get_categories.replace('categories_id',id);
                $('#form_categories').attr('action',route).attr('method','post');

                $.ajax({
                    url: get_categories,
                    method: 'GET',
                    data: {
                        _token: '{{csrf_token()}}',
                    },
                    success:function(data){
                        $("input[name='title']").val(data.title);
                        $("input[name='description']").val(data.description);
                        $("input[name='keywords']").val(data.keywords);
                        $("input[name='sort_id']").val(data.sort_id);
                        $("select[name='type']").val(data.type);
                        $("input[name='name']").val(data.name);
                        $("input[name='slug']").val(data.slug);
                        $("select[name='locate']").val(data.locate);
                        if ($("select[name='showindex']").val(data.showindex)) {
                            $("select[name='showindex']").attr("checked","checked");
                        }
                        $("input[name='icon']").val(data.icon);
                        $("texarea[name='text']").val(data.text);
                        $("input[name='image']").val(data.image);
                        $('#lfm').attr('src',data.image);
                    }
                });
            })
        </script>
    @endpush
</x-app-layout>
