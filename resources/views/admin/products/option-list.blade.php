<x-app-layout>
    <x-slot name="header">
        {{ __('Danh mục chức năng') }}
    </x-slot>
    <form class="input-group" action="{{ route('admin.products.options.store') }}" method="POST">
        @csrf
        <div class="input-group-prepend">
            <select class="form-control" name="category">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <input class="form-control" placeholder="Tên chức năng" name="name">
            <input class="form-control" placeholder="Giá" name="price">
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
    </form>
    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
            <th style="width: 5%">Thứ tự</th>
            <th>Danh mục</th>
            <th>Chức năng</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($categories as $index => $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{$category->name}}
                    </td>
                    <td>
                        <ul>
                            @foreach ($category->Options as $option)
                                <li>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <b>{{ $option->name }}</b>
                                        </div>
                                        <div class="col-md-4">
                                            {{number_format($option->price) }}VNĐ
                                        </div>
                                        <div class="col-md-4">
                                            <form action="{{ route('admin.products.options.delete',$option->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-xs btn-danger"><i class="ion-trash-b"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>