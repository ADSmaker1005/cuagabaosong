<div>
    <x-app-layout>
        <x-slot name="header">
            {{ $bill->name }} <b>{{ date('d-m-Y', strtotime($bill->created_at)) }}</b>
        </x-slot>
        <form wire:submit.prevent="sendGHTK">
            <div class="row">
                <div class="col-md-6">
                    
                    <div class="text-center mt-5 mb-2" style="color: #038F4A">
                        <b>Danh sách hàng hóa hiện có</b>
                    </div>
                    <div style="max-height: 50vh;overflow:auto">
                        <table class="table table-bordered" >
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($bill->Carts as $cart)
                                @php
                                    $sub_total = 0;
                                @endphp
                                <tr>
                                    <th rowspan="2">
                                        <img src="{{ $cart->img }}" style="width: 100px;height:100px">
                                    </th>
                                    <th>
                                        {{ $cart->name }}<br>
                                    </th>
                                    <th>
                                        <b>{{ number_format($cart->newprice) }}</b>
                                    </th>
                                    <th rowspan="2">
                                        @if ($cart->CartProductOptions->count() > 0)
                                            @foreach ($cart->CartProductOptions as $option)
                                            -  <b>{{ $option->name }}</b>:{{ number_format($option->price) }} <br>
                                                @php
                                                    $sub_total +=$option->price
                                                @endphp
                                            @endforeach
                                        @else
                                            Không có thêm chức năng    
                                        @endif
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-center">
                                        {{ $cart->weight }}
                                    </th>
                                    <td>
                                        {{ $cart->qty }}
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2">
                                        Tạm tính
                                    </th>
                                    <th colspan="2">
                                        {{ number_format($sub_total +=$cart->newprice*$cart->qty) }} VNĐ
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="2">
                                        Tình trạng
                                    </th>
                                    <th colspan="2">
                                        @if ( $cart->weight == "0")
                                            <span class="text-danger">Chưa có khối lượng</span><br>
                                        @endif
                                        @if ($cart->code == "0")
                                            Code không có mặc định là: <b>{{ $cart->id }}</b>
                                        @endif
                                    </th>
                                </tr>
                                
                                @php
                                    $total += $sub_total;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <input type="hidden" value="Khác" class="form-control" name="hamlet" id="select_hamlet" title="Tên thôn/ấp/xóm/tổ/… của người nhận hàng hóa. Nếu không có, vui lòng điền “Khác”">
                </div>
                <div class="col-md-6">
                        <div style="color: #038F4A" class="mb-2">
                            <b>NGƯỜI NHẬN</b>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text text-center" style="width:50px;color: #038F4A;border:none;background-color:white"><i class="fas fa-phone-alt"></i></span>
                                        </div>
                                        <input class="form-control text-center" style="color: #038F4A" placeholder="Nhập số điện thoại khách hàng" wire:model="tel" title="Số điện thoại liên hệ nơi nhận hàng hóa">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text text-center" style="width:50px;color: #038F4A;border:none;background-color:white"><i class="far fa-user"></i></span>
                                        </div>
                                        <input class="form-control text-center" style="color: #038F4A" placeholder="Tên khách hàng" wire:model="name" title="Tên người liên hệ nhận hàng">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text text-center" style="width:50px;color: #038F4A;border:none;background-color:white"><i class="fas fa-home"></i></span>
                                        </div>
                                        <input class="form-control " style="color: #038F4A" wire:model="address" id="address" title=" Địa chỉ chi tiết của người nhận hàng, ví dụ: Chung cư CT1, ngõ 58, đường Trần Bình">
                                    </div>
                                </div>
                            </div>
                            <div class="form-control" style="color: #038F4A">
                                Địa chỉ giao : Đường: {{ $bill->Street->_name }},Phường: {{ $bill->Ward->_name }},Quận: {{ $bill->District->name }},Thành phố: {{ $bill->Province->name }}
                            </div>
                            <div class="col-md-12 text-center">
                                <small class="text-danger">Giá trị mặc định lấy theo hóa đơn khách gửi không nhất thiết điền lại</small>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control search" wire:model="form_province" x-data x-init="$('.search').selectpicker({liveSearch : true})" title="Tên tỉnh/thành phố nơi nhận hàng hóa">
                                        <option>Chọn</option>
                                        @foreach ($provice as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @dump($form_district)
                                    @if ($form_province)
                                    <select class="form-control search" wire:model="form_district" x-data x-init="$('.search').selectpicker({liveSearch : true})" title="Tên quận/huyện nơi nhận hàng hóa">
                                        <option>Chọn</option>
                                        @foreach ($district as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @else
                                        <div class="form-control text-center text-danger">
                                            Vui lòng chọn thành phố
                                        </div>
                                    @endif
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @if ($form_district)
                                        <select class="form-control search" wire:model="form_ward" x-data x-init="$('.search').selectpicker({liveSearch : true})" title="Tên phường/xã của người nhận hàng hóa (Bắt buộc khi không có đường/phố)">
                                            <option value="">Chọn</option>
                                            @foreach ($ward as $item)
                                                <option value="{{ $item->id }}">{{ $item->_name }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <div class="form-control text-center text-danger">
                                            Vui lòng chọn quận && thành phố
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @if ($form_district)
                                    <select class="form-control search" wire:model="form_street" x-data x-init="$('.search').selectpicker({liveSearch : true})" title="Tên đường/phố của người nhận hàng hóa (Bắt buộc khi không có phường/xã)">
                                        <option value="">Chọn</option>
                                        @foreach ($street as $item)
                                            <option value="{{ $item->id }}">{{ $item->_name }}</option>
                                        @endforeach
                                    </select>
                                    @else
                                        <div class="form-control text-center text-danger">
                                            Vui lòng chọn quận && thành phố
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class=" mb-2" style="color: #038F4A">
                            <b>THÔNG TIN LẤY HÀNG</b>
                        </div>
                        <table class="table table-bordered text-center">
                            <tr>
                                <th>
                                    Hình thức gửi
                                </th>
                                <td>
                                    <input type="radio" name="pick_option" id="pick_option_radio1" checked value="cod"><label for="pick_option_radio1">lấy hàng tận nơi</label>
                                </td>
                                <td>
                                    <input type="radio" name="pick_option" id="pick_option_radio2" value="post"><label for="pick_option_radio2">gửi hàng bưu cục</label>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Địa chỉ lấy hàng
                                </th>
                                <td colspan="2">
                                    {{ $my_shop != null ? "Số: ".$my_shop->pick_address : "" }}
                                    {{ $my_shop != null ? ";Đường: ".$my_shop->pick_street: "" }}
                                    {{ $my_shop != null ? ";Phường: ".$my_shop->pick_ward : "" }}
                                    {{ $my_shop != null ? ";Quận: ".$my_shop->pick_district : "" }}
                                    {{ $my_shop != null ? ";Thành phố: ".$my_shop->pick_province : "" }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Giao - nhận
                                </th>
                                <th>
                                    <div class="form-group">
                                        <select name="pick_work_shift" id="select_pick_work_shift" class="form-control">
                                            <option value="1">Shop giao sáng</option>
                                            <option value="2">Shop giao trưa</option>
                                            <option value="3">Shop giao tối</option>
                                        </select>
                                    </div>
                                </th>
                                <th>
                                    <div class="form-group">
                                        <select name="deliver_work_shift" id="select_deliver_work_shift" class="form-control">
                                            <option value="1">Khách nhận sáng</option>
                                            <option value="2">Khách nhận trưa</option>
                                            <option value="3">Khách nhận tối</option>
                                        </select>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <label>Đơn vị hàng hóa</label>
                                </td>
                                <td>
                                    <input type="radio" name="weight_option" checked value="kilogram" id="select_weight_option1"><label for="select_weight_option1">Kilogram</label>
                                </td>
                                <td>
                                    <input type="radio" name="weight_option"  value="gram" id="select_weight_option2"><label for="select_weight_option2">Gram</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Khối lượng
                                </td>
                                <td colspan="2">
                                    <input title="total_weight" style="color: #038F4A" type="text" value="{{ $bill->Carts->sum("weight") }}" id="select_total_weight" title="(mặc định theo tổng khối lượng SP)" class="form-control text-center">
                                </td>  
                            </tr>
                        </table>
                        <div class=" mb-2" style="color: #038F4A">
                            <b>THÔNG TIN HÀNG HÓA</b>
                        </div>
                        <table class="table text-center mt-2" style="color: #038F4A">
                            <tr>
                                <th>
                                    Hình thức vận chuyển
                                </th>
                                <td>
                                    <input type="radio" checked name="transport" id="select_actual_transfer_method1" value="road" title="Nếu đơn hàng được chuyển bằng đường bộ (road), bạn sẽ nhận được thông báo của GHTK.">
                                    <label for="select_actual_transfer_method1">Đường bộ</label>
                                </td>
                                <td>
                                    <input type="radio" name="transport" id="select_actual_transfer_method2" value="fly">
                                    <label for="select_actual_transfer_method2">Đường bay</label>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Phí ship
                                </th>
                                <td>
                                    <input type="radio" name="is_freeship" checked value="0" id="select_is_freeship1" title="Freeship cho người nhận hàng."><label for="select_is_freeship1">Khách trả</label>
                                </td>
                                <td>
                                    <input type="radio" name="is_freeship"  value="1" id="select_is_freeship2"><label for="select_is_freeship2">Shop trả</label>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Hàng dễ vỡ
                                </th>
                                <td>
                                    <input type="radio" name="is_broke" checked value="1" id="select_is_broke1" title="Freeship cho người nhận hàng."><label for="select_is_broke1">Dễ vỡ</label>
                                </td>
                                <td>
                                    <input type="radio" name="is_broke" value="0" id="select_is_broke2"><label for="select_is_broke2">Không</label>
                                </td>
                            </tr>
                        </table>
                        <div class="form-group">
                            <label>PHÍ SHIP</label>
                            <input class="form-control text-center" readonly name="cod_price" value="{{ $price_transfer->fee->delivery == true ? $price_transfer->fee->ship_fee_only : "Không chính xác thông tin" }}" id="TransferPriceGain">
                        </div>
                        @if ($price_transfer->fee->delivery == true )
                            @php
                                $option1 =isset($price_transfer->fee->extFees[0]) ? $price_transfer->fee->extFees[0] : "";
                                $option2 = isset($price_transfer->fee->extFees[1]) ? $price_transfer->fee->extFees[1] : "";
                            @endphp
                        <table class="mt-2" id="TransferOption">
                            @if ($option1)
                            <tr id="TransferOption1">
                                <th class="pl-2 pr-2">
                                    {{ $option1->title }}
                                </th>
                                <td>
                                    <div class="form-control text-center">
                                        {{ $option1->display }}
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @if ($option2)
                            <tr>
                                <th class="pl-2 pr-2">
                                    {{ $option2->title }}
                                </th>
                                <td>
                                    <div class="form-control text-center">
                                        {{ $option2->display }}
                                    </div>
                                </td>
                            </tr>
                            @endif
                        </table>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Thu hộ</label>
                                    <input type="text" class="form-control text-center" value="{{ $total }}" id="totalProductPrice" name="total_price">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Giá trị hàng hóa</label>
                                    <input type="text" class="form-control text-center" readonly value="{{ $total }}" id="totalProductTruePrice">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Bảo hiểm</label>
                                    <div class="form-control text-center" id="insuranceFee" style="color: #038F4A">
                                        @if ($price_transfer->fee->delivery == true )
                                            @if ($price_transfer->fee->insurance_fee != null)
                                            {{ number_format($price_transfer->fee->insurance_fee) }}
                                            @else
                                            Miễn phí BH
                                            @endif
                                        @else
                                            Tông tin giao hàng không chính xác
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="text-center form-group mb-3 mt-3" style="color: #038F4A">
                            <label>Tổng tiền thu</label>
                            <input id="TransferPriceTotal" class="text-center form-control" readonly value="{{ $price_transfer->fee->delivery == true ? ($price_transfer->fee->fee + $total) : $total }}">
                        </div>
                        <hr>
                        
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ghi chú</label>
                                    <input class="form-control taginput" name="note"  data-role="tagsinput" value="Dễ vỡ, giá trị cao, tiêu chuẩn" name="tags">
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Ghi chú thêm</label>
                                <select class="select_tags form-control" name="more_note[]" multiple>
                                    <option>Giao hàng một phần</option>
                                    <option>Có vấn đề gọi shop, không tự ý hủy chọn</option>
                                    <option>Gọi khách trước khi giao</option>
                                    <option>Khách không lấy hàng thu ship</option>
                                </select>
                            </div>
                        </div>
                        
                        
                        <div class="row mt-5">
                            <div class="col-md-12 form-group">
                                <label>Mã đơn KH</label>
                                <input type="text" class="form-control" name="label_id" id="select_label_id" title="Mã vận đơn được cấp trước cho đối tác - mặc định không sử dụng được field này, cấu hình riêng cho từng gói dịch vụ">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>xfast vận chuyển<small class="text-danger">*</small></label>
                                @if ($xfast->success == 'false')
                                    <div class="row">
                                        @foreach ($xfast->data as $item)
                                            <div class="col text-center form-control">
                                                {{ $item->pick }} --- {{ $item->deliver }}
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center form-control">
                                        {{ $xfast->message }}
                                    </div>
                                @endif
                                
                            </div>
                            
                            <input class="form-control" name="email" value="{{ $my_shop->return_email }}" id="select_email" type="hidden">
                        </div>
                    
                        <div class="text-center">
                            @if ($bill->Carts->where("weight","0")->count() > 0)
                                <div class="text-danger">Chưa kiểm tra phí vận chuyển được !!!</div>
                            @else
                            @endif
                        </div>
                </div>
            </div>
            @if (session()->has('success'))
            <div class="alert alert-success bg-success text-white">
                {{ session('success') }}
            </div>
            @endif
            @if (session()->has('danger'))
                <div class="alert alert-danger bg-danger text-white">
                    {{ session('danger') }}
                </div>
            @endif
            <div class="text-center">
                @if ($my_shop)
                    <button type="submit" class="btn btn-success">Báo bên GHTK</button>
                @else
                    <div class="text-center text-danger">
                        Vui lòng nhập thông tin giao hàng
                    </div>
                @endif
            </div>
        </form>
    </x-app-layout>
</div>