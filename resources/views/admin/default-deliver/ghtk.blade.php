<x-app-layout>
    <x-slot name="header">
            {{ __('Cài đặt giỏ hàng GHTK') }}
    </x-slot>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="send-tab" data-toggle="tab" href="#send" role="tab" aria-controls="send" aria-selected="true">Giao hàng</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="return-tab" data-toggle="tab" href="#return" role="tab" aria-controls="return" aria-selected="false">Trả hàng</a>
        </li>
    </ul>
    <form action="{{ route('admin.ghtk-option.update') }}" method="POST">
        @csrf
        @method('POST')
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="send" role="tabpanel" aria-labelledby="send-tab">
                <div class="text-center mb-2 mt-2">
                    <b class="text-danger">Nơi lấy hàng đi</b>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Người liên hệ lấy hàng hóa<small class="text-danger">*</small></label>
                            <input class="form-control" name="pick_name" value="{{ $info ? $info->pick_name : "" }}" title="Tên người liên hệ lấy hàng hóa">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Địa chỉ (Số nhà)<small class="text-danger">*</small></label>
                            <input class="form-control" name="pick_address" value="{{ $info ? $info->pick_address : "" }}" title="Địa chỉ ngắn gọn để lấy hàng hóa. Ví dụ: nhà số 5, tổ 3, ngách 11, ngõ 45">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Số điện thoại<small class="text-danger">*</small></label>
                            <input class="form-control" name="pick_tel" value="{{ $info ? $info->pick_tel : "" }}" title="Số điện thoại liên hệ nơi lấy hàng hóa">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tỉnh/Thành phố<small class="text-danger">*</small></label>
                            <input class="form-control" name="pick_province" value="{{ $info ? $info->pick_province : "" }}"  title="Tên tỉnh/thành phố nơi lấy hàng hóa">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Quận<small class="text-danger">*</small></label>
                            <input class="form-control" name="pick_district" value="{{ $info ? $info->pick_district : "" }}" title="Tên quận/huyện nơi lấy hàng hóa">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Phường</label>
                            <input class="form-control" name="pick_ward" value="{{ $info ? $info->pick_ward : "" }}" title="Tên phường/xã nơi lấy hàng hóa">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Đường</label>
                            <input class="form-control" name="pick_street" value="{{ $info ? $info->pick_street : "" }}" title="Tên đường/phố nơi lấy hàng hóa">
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="return" role="tabpanel" aria-labelledby="return-tab">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Mặc định(nơi giao hàng cũng là nơi trả)</label>
                        <select class="form-control" name="use_return_address">
                            <option value="0" selected>Mặc định</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Người liên hệ<small class="text-danger">*</small></label>
                            <input class="form-control" name="return_name" value="{{ $info ? $info->return_name : "" }}" title="Tên người liên hệ nhận hàng">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Địa chỉ (Số nhà)<small class="text-danger">*</small></label>
                            <input class="form-control" name="return_address" value="{{ $info ? $info->return_address : "" }}" title=" Địa chỉ chi tiết của người nhận hàng, ví dụ: Chung cư CT1, ngõ 58, đường Trần Bình">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Số điện thoại<small class="text-danger">*</small></label>
                            <input class="form-control" name="return_tel" value="{{ $info ? $info->return_tel : "" }}" title="Số điện thoại liên hệ nơi nhận hàng hóa">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tỉnh/Thành phố<small class="text-danger">*</small></label>
                            <input class="form-control" name="return_province" value="{{ $info ? $info->return_province : "" }}" title="Tên tỉnh/thành phố nơi trả hàng hóa">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Quận<small class="text-danger">*</small></label>
                            <input class="form-control" name="return_district" value="{{ $info ? $info->return_district : "" }}" title="Tên quận/huyện nơi trả hàng hóa">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Phường<small class="text-danger">*</small></label>
                            <input class="form-control" name="return_ward" value="{{ $info ? $info->return_ward : "" }}" title="Tên phường/xã của người nhận hàng hóa (Bắt buộc khi không có đường/phố)">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Đường<small class="text-danger">*</small></label>
                            <input class="form-control" name="return_street" value="{{ $info ? $info->return_street : "" }}" title="Tên đường/phố của người nhận hàng hóa (Bắt buộc khi không có phường/xã)">
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Email người trả hàng hóa<small class="text-danger">*</small></label>
                        <input class="form-control" name="return_email" value="{{ $info ? $info->return_email : "" }}" type="email">
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3 text-center">
            <button class="btn btn-success">Cập nhật</button>
        </div>
    </form>
    @push('scripts')
@endpush
</x-app-layout>
