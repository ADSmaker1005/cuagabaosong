<div class="modal" tabindex="-1" id="cart__payment--modal" role="dialog">
    <div class="modal-dialog" role="document">
      <form class="modal-content" id="cart__payment--form" action="" method="POST">
        @csrf
        @method('POST')
        <div class="modal-header">
          <h5 class="modal-title">Thanh toán ngay</h5>
        </div>
        <div class="modal-body">
          <div class="form-group">
              <label>Họ và tên</label>
            <input class="form-control" required min="8" name="name" placeholder="Họ & Tên">
          </div>
          <div class="form-group">
            <label>Số điện thoại</label>
            <input type="text" name="call" required min="8" class="form-control" placeholder="Số điện thoại">
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                  <label>Tỉnh/Thành phố<small class="text-danger">*</small></label>
                  <select class="form-control select_province" name="province" title="Tên tỉnh/thành phố nơi nhận hàng hóa">
                      <option>Chọn</option>
                      @foreach ($provice as $item)
                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                      @endforeach
                  </select>
              </div>
          </div>
          <div class="col-md-12">
              <div class="form-group">
                  <label>Quận<small class="text-danger">*</small></label>
                  <select class="form-control select_district" name="district"  title="Tên quận/huyện nơi nhận hàng hóa"></select>
              </div>
          </div>
          <div class="col-md-12">
              <div class="form-group">
                  <label>Phường</label>
                  <select class="form-control select_ward" name="ward" title="Tên phường/xã của người nhận hàng hóa (Bắt buộc khi không có đường/phố)"></select>
              </div>
          </div>
          <div class="col-md-12">
              <div class="form-group">
                  <label>Đường</label>
                  <select class="form-control select_street" name="street" title="Tên đường/phố của người nhận hàng hóa (Bắt buộc khi không có phường/xã)"></select>
              </div>
          </div>
          </div>
          <div class="form-group">
            <label>Địa chỉ</label>
            <input type="text" name="address" required class="form-control" placeholder="Địa chỉ">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn" style="background-color: #80FE00;color:black;font-weight:bold">Mua hàng</button>
        </div>
      </form>
    </div>
</div>
