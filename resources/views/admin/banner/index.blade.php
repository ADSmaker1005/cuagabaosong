<x-app-layout>
    <x-slot name="header">
        {{ __('Banner') }}
    </x-slot>
    @push('css')

    @endpush
    <div class="text-center">
        <!-- Large modal -->
        <button type="button" class="btn btn-danger waves-effect waves-light" id="add_banner_btn">Thêm banner</button>
    </div>

    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
            <th style="width: 5%">Thứ tự</th>
            <th>Tên banner</th>
            <th>banner</th>
            <th>Vị trí</th>
            <th style="width: 5%">Xóa</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($banners as $banner)
                <tr>
                    <td>{{  $banner->sort_by ? $banner->sort_by : 1 }}</td>
                    <td>
                        @if ($banner->link == null)
                            <div class="block badge badge-default">{{  $banner->name }}</div>
                        @else
                            <a href="{{  ($banner->link) }}" class="block badge badge-success">{{  $banner->name }}</a>
                        @endif
                    </td>
                    <td>
                        <img class="block w-100" src="{{  $banner->images }}">
                    </td>
                    <td>
                        <form action="{{ url()->current()."/update/".$banner->id }}" method="POST">
                            @csrf
                            @method('POST')
                            <select class="formcontrol" onchange="this.form.submit()" name="locate">
                                <option value="0" {{ ($banner->locate == '0') ? 'selected' : '' }}>
                                    Chọn
                                </option>
                                <option value="1" {{ ($banner->locate == '1') ? 'selected' : '' }}>
                                    Trang chủ phần đầu bên trái
                                </option>
                                <option value="2" {{ ($banner->locate == '2') ? 'selected' : '' }}>
                                    Trang chủ phần đầu bên phải
                                </option>
                                <option value="3" {{ ($banner->locate == '3') ? 'selected' : '' }}>
                                    Trang chủ banner
                                </option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <button type="button" class="btn btn-warning waves-effect waves-light edit_banner_btn" data-id="{{ $banner->id }}">Sửa banner</button>
                        <form action="{{ url()->current()."/delete/".$banner->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-xs btn-danger"><i class="ion-trash-b"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@extends('admin.banner.modal')
    @push('scripts')
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
        </script>
        <script>
            $("#add_banner_btn").on("click",function(){
                $("input[name='sort_by']").val('');
                $("input[name='name']").val('');
                $("select[name='locate']").val('');
                $("input[name='link']").val('');
                $("input[name='images']").val('');
                $("#lfm").attr('src',"{{ asset('images/blank.png') }}");
                $('#create_banner_modal').modal("toggle");
                route = "{{ route('admin.banner.store') }}";
                $('#banner_form').attr('action',route).attr('method','post');

            })
        </script>
        <script>
            $('#datatable').on("click",".edit_banner_btn",function(){
                $('#create_banner_modal').modal("toggle");
                var route = "{{ route('admin.banner.update',['banner_id']) }}";
                var id = $(this).data('id');
                route = route.replace('banner_id',id);
                $('#banner_form').attr('action',route).attr('method','post');
                var get_banner = "{{ route('admin.banner.ajax',['banner_id']) }}";
                get_banner = get_banner.replace('banner_id',id);
                $.ajax({
                    url: get_banner,
                    method: 'GET',
                    data: {
                        _token: '{{csrf_token()}}',
                    },
                    success:function(data){
                        $("input[name='sort_by']").val(data.sort_by);
                        $("input[name='name']").val(data.name);
                        $("select[name='locate']").val(data.locate);
                        $("input[name='link']").val(data.link);
                        $("input[name='images']").val(data.images);
                        $("#lfm").attr('src',data.images);
                    }
                });
            })
        </script>
    @endpush
</x-app-layout>
