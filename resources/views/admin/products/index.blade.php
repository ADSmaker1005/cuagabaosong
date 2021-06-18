<x-app-layout>
    <x-slot name="header">
        {{ __('Sắp xếp bài viết') }}
    </x-slot>

    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
            <th style="width: 5%">Thứ tự</th>
            <th>Tên product</th>
            <th>product</th>
            <th>Vị trí</th>
            <th>Chức năng</th>
            <th>Danh mục</th>
            <th style="width: 5%">Sửa</th>
            <th style="width: 5%">Xóa</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($products as $index => $product)
                <tr>
                    <td>{{ $index+=1 }}</td>
                    <td>
                        {{  $product->name }}
                    </td>
                    <td style="width: 100px">
                        <img class="block w-100" src="{{  $product->img }}">
                    </td>
                    <td>
                        {{ ($product->locate == '1') ? 'flashsale' : 'không' }}
                    </td>
                    <th>
                        <ul>
                            @foreach ($product->OptionCategories as $category)
                                <li>
                                    <span class="badge badge-info">{{ $category->name }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </th>
                    <td>
                        <ul>
                            @foreach ($product->Categories as $category)
                                <li>
                                    <span class="badge badge-info">{{ $category->name }}</span>
                                </li>
                            @endforeach
                        </ul>

                    </td>
                    <td>
                        <a href="{{ route('admin.products.show',$product->id) }}" class="btn btn-xs btn-warning"><i class="ion-hammer"></i></a>
                    </td>
                    <td>
                        <form action="{{ route('admin.products.destroy',$product->id) }}" method="POST">
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
