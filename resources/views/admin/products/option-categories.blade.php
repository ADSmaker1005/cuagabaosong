<x-app-layout>
    <x-slot name="header">
        {{ __('Danh mục chức năng') }}
    </x-slot>
    <form class="input-group" action="{{ route('admin.products.options.categories.store') }}" method="POST">
        @csrf
        <div class="input-group-prepend">
            <input class="form-control" name="name">
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
    </form>
    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
            <th style="width: 5%">Thứ tự</th>
            <th>Danh mục chức năng</th>
            <th style="width: 5%">Xóa</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($categories as $index => $item)
                <tr>
                    <td>{{ $index+=1 }}</td>
                    <td>
                        {{  $item->name }}
                    </td>
                    <td>
                        <form action="{{ route('admin.products.options.categories.destroy',$item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-xs btn-danger"><i class="ion-trash-b"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>