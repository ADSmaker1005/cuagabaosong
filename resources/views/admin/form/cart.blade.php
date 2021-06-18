<x-app-layout>
    <x-slot name="header">
            {{ __('Khách đặt hàng') }}
    </x-slot>
    <div style="width: 100%;overflow:auto">
        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
            <tr>
                <th>
                    Thông tin
                </th>
                <th>
                    Giỏ hàng
                </th>
            </tr>
            </thead>
            <tbody>
                @foreach ($bills as $bill)
                <tr>
                    <td style="width: 40%">
                        <span class="badge badge-success">{{ date('d-m-Y', strtotime($bill->created_at)) }}</span><span class="badge badge-dark">{{ date('H:m', strtotime($bill->created_at)) }}</span>
                        <b>{{ $bill->name }}</b><br>
                        Số điện thoại:{{ $bill->call }}<br>
                        Địa chỉ: {{ $bill->address }}
                        <div class="text-center">
                                <a href="{{ route('admin.form.bill.print',$bill->id) }}" class="btn btn-danger">In hóa đơn</a>
                                <a href="{{ route('admin.form.bill.showGHTK',$bill->id) }}" target="_blank" rel="noopener noreferrer" class="btn btn-success">Gửi cho đơn vị giao hàng</a>
                        </div>
                        <table class="table table-bordered mt-2">
                            <tr class="table-primary">
                                <th>
                                    Tên đơn vị giao hàng
                                </th>
                                <th>
                                    Chi phí giao
                                </th>
                                <th>
                                    tình trạng
                                </th>
                            </tr>
                        </table>
                    </td>
                    <td>
                        @if ($bill->Carts->count() > 0)
                            @php
                                $total = 0;
                            @endphp
                            <div class="row">
                                @foreach ($bill->Carts as $cart)
                                <div class="col-md-8">
                                    <b>Tên hàng: </b>{{ $cart->name }}<br>
                                    <b>Số lượng</b> {{ $cart->qty }} <br>
                                    <b>Giá gốc:</b> {{ number_format($cart->newprice) }} VNĐ<br>
                                    @if ($cart->CartProductOptions->count() > 0)
                                    <b>Chức năng thêm:</b><br>
                                        @foreach ($cart->CartProductOptions as $option)
                                                -  <b>{{ $option->name }}</b>:{{ $option->price }} <br>
                                                @php
                                                    $total +=$option->price
                                                @endphp
                                        @endforeach
                                    @endif
                                    
                                    <b>Giá bán:</b> {{ number_format($total +=$cart->newprice*$cart->qty) }} VNĐ<br>
                                    <hr>
                                    
                                </div>
                                <div class="col-md-4">
                                    <img class="w-100 h-100 d-block" src="{{ $cart->img != null ? $cart->img : "" }}">
                                </div>
                                @endforeach
                            </div>
                            Tổng <span class="btn btn-danger">{{ number_format($total) }}</span> VNĐ
                        @else
                            không có thông tin
                        @endif
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
    {{ $bills->links() }}

@push('css')

@endpush
@push('scripts')

@endpush
</x-app-layout>    