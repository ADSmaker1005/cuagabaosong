<x-app-layout>
    <x-slot name="header">
            {{ __('Khách phản hồi') }}
    </x-slot>
    <div style="width: 100%;overflow:auto">
        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
            <tr>
                <th style="width: 5%">Thứ tự</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Nội dung</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($form as $index => $item)
                <tr>
                    <td>
                        {{ $index+=1 }}
                    </td>
                    <td>
                        {{ $item->name }}
                    </td>
                    <td>
                        {{ $item->email }}
                    </td>
                    <td>
                        <b>Tên sản phẩm: </b>{{ $item->Product->name }}<br>
                        <b>Số lượng sao: </b>{{ $item->star }}
                    </td>
                    <td>
                        {!! $item->content !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    

    @push('css')

    @endpush
    @push('scripts')

    @endpush
</x-app-layout>
