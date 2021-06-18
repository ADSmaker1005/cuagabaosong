<x-app-layout>
    <x-slot name="header">
        {{ __('Đối tác') }}
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
            <th>Tên đối tác</th>
            <th>Logo</th>
            <th>Vị trí</th>
            <th style="width: 5%">Xóa</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($partners as $partner)
                <tr>
                    <td><a href="#" id="inline-sort" data-pk="{{ $partner->id }}" data-name="sort_by" data-type="number" data-title="Enter sort number">{{  $partner->sort_by ? $partner->sort_by : 1 }}</a></td>
                    <td>
                        @if ($partner->link == null)
                            <div class="block badge badge-default">{{  $partner->name }}</div>
                        @else
                            <a href="{{  ($partner->link) }}" class="block badge badge-success">{{  $partner->name }}</a>
                        @endif
                    </td>
                    <td>
                        <img class="block" style="width:50px" src="{{  $partner->images }}">
                    </td>
                    <td>
                        <form action="{{ route('admin.partner.update',$partner->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select class="formcontrol" onchange="this.form.submit()" name="locate">
                                <option value="0" {{ ($partner->locate == '0') ? 'selected' : '' }}>
                                    Chọn
                                </option>
                                <option value="1" {{ ($partner->locate == '1') ? 'selected' : '' }}>
                                    Trang chủ
                                </option>
                                <option value="2" {{ ($partner->locate == '2') ? 'selected' : '' }}>
                                    Trang tin tuc
                                </option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <button type="button" class="btn btn-warning waves-effect waves-light edit_banner_btn" data-id="{{ $partner->id }}">Sửa</button>
                        <form action="{{ route('admin.partner.destroy',$partner->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-xs btn-danger"><i class="ion-trash-b"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@extends('admin.partner.modal')
    @push('scripts')
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $('#inline-sort').editable({
                url: "{{ route('admin.partner.inline') }}",
                title: 'Sort',
                mode: 'inline',
                inputclass: 'form-control-sm',
                success: function (response, newValue)
                {
                    console.log('Updated', response);
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
                route = "{{ route('admin.partner.store') }}";
                $('#banner_form').attr('action',route).attr('method','post');

            })
        </script>
        <script>
            $('#datatable').on("click",".edit_banner_btn",function(){
                $('#create_banner_modal').modal("toggle");
                var route = "{{ route('admin.partner.update',['banner_id']) }}";
                var id = $(this).data('id');
                route = route.replace('banner_id',id);
                $('#banner_form').attr('action',route).attr('method','post');
                var get_banner = "{{ route('admin.partner.ajax',['banner_id']) }}";
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
