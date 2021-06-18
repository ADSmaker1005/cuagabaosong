<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<style>
    @media print   {
        .print{ display: none};
        .font{
            font-size: 12px
        }
    } 
</style>    
<div class="text-center print">
        <button class="btn btn-danger" onclick="window.print()">in hóa đơn</button>
    </div>
<div class="text-center">
        <img style="width:200px" src="{{ $themes->logo }}">
    </div>
    <div class="container">
        <div class="text-center">
            <b>HÓA ĐƠN</b>
        </div>
        <div class="row">
            <div class="col-2">
                
            </div>
            <div class="col-8">
                <div class="row">
                    <div class="col-6">
                        STTKH: {{ $bill->id }}
                    </div>
                    <div class="col-6">
                        Thu Ngân : {{ Auth::user()->name }}
                    </div>
                </div>
            </div>
            <div class="col-2">
                
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                
            </div>
            <div class="col-8">
                Họ tên : {{ $bill->name }}<br>
            Địa chỉ: {{ $bill->address }} .<br>
            Số điện thoại: {{ $bill->call }} .
            </div>
            <div class="col-2">
                
            </div>
        </div>
        <div class="row">
            <div class="col-2">

            </div>
            <div class="col-8">
                <table class="table table-bordered text-center font">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <Th>
                                Tên sản phẩm
                            </Th>
                            <th>
                                Số lượng
                            </th>
                            <th>
                                Giá
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($bill->Carts as $cart)
                        @php
                            $total_row = 0;
                        @endphp
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    <b>{{ $cart->name }}</b><br>
                                    @if ($cart->CartProductOptions->count() > 0)
                                        @foreach ($cart->CartProductOptions as $option)
                                            + <span>{{ $option->name }}</span>:{{ $total_row +=$option->price }} <br>
                                        @endforeach
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ $cart->qty }}
                                </td>
                                <td>
                                    {{ number_format($total_row +=$cart->newprice*$cart->qty) }}
                                </td>
                            </tr>
                            @php
                                $total += $total_row;
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" class="text-center">
                                Tổng giá
                            </th>
                            <th class="text-center">
                                {{ $bill->Carts->sum('qty') }}
                            </th>
                            <th>
                                {{ $total }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-2">

            </div>
        </div>
        <div class="text-center">
            <b>Cảm ơn quý khách đã ủng hộ</b><br>
            Mọi chi tiết vui lòng liên hệ: {{ $themes->hotline }} lò cựa Bảo Song<br>
            Địa chỉ : 15a Phước hoà , Xã Phước hiệp , huyện Củ Chi , Hồ Chí Minh
        </div>
    </div>
    
