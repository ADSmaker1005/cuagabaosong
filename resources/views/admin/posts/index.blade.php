<x-app-layout>
    <x-slot name="header">
        {{ __('Sắp xếp bài viết') }}
    </x-slot>

    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
            <th style="width: 5%">Thứ tự</th>
            <th>Tên post</th>
            <th>post</th>
            <th>Vị trí</th>
            <th>Danh mục</th>
            <th style="width: 5%">Sửa</th>
            <th style="width: 5%">Xóa</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($posts as $index => $post)
                <tr>
                    <td>{{ $index+=1 }}</td>
                    <td>
                        {{  $post->name }}
                    </td>
                    <td >
                        <img style="width: 100px" class="block" src="{{  $post->img }}">
                    </td>
                    <td>
                        <form action="{{ route('admin.posts.update',$post->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select class="formcontrol" onchange="this.form.submit()" name="locate">
                                <option value="0" {{ ($post->locate == '0') ? 'selected' : '' }}>
                                    Chọn
                                </option>
                                <option value="1" {{ ($post->locate == '1') ? 'selected' : '' }}>
                                    Trang chủ và chân trang
                                </option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <ul>
                            @foreach ($post->Categories as $category)
                                <li>
                                    <span class="badge badge-info">{{ $category->name }}</span>
                                </li>
                            @endforeach
                        </ul>

                    </td>
                    <td>
                        <a href="{{ route('admin.posts.show',$post->id) }}" class="btn btn-xs btn-warning"><i class="ion-hammer"></i></a>
                    </td>
                    <td>
                        <form action="{{ route('admin.posts.destroy',$post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-xs btn-danger"><i class="ion-trash-b"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @push('css')

    @endpush
    @push('scripts')

    @endpush
</x-app-layout>
