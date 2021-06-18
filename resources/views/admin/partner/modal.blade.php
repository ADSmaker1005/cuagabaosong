    <!--  Modal content for the above example -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="create_banner_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Partner</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="banner_form" >
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Thứ tự</label>
                                    <input type="number" value="0" name="sort_by" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tên</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Vị trí</label>
                                    <select class="form-control" name="locate">
                                        <option value="0">Chọn</option>
                                        <option value="1">Trang chủ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Link</label>
                                    <input type="text" name="link" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Hình ảnh</label>
                                    <div class="input-group">
                                        <img src="{{ asset('images/blank.png') }}" class="block w-100" style="height: 200px" id="lfm" data-input="thumbnail">
                                        <input id="thumbnail" class="form-control" type="hidden" name="images">
                                    </div>
                                </div>
                                <script>
                                    var btn = $('#lfm');
                                    var input1 = $('#thumbnail');

                                    function Manager(a, b)
                                    {
                                        a.filemanager('image');
                                        b.on("change keyup paste click",function(){
                                            var x = a;
                                            var y = b.val();
                                            console.log(y);
                                            x.attr('src', y);
                                        });
                                    }
                                    window.Manager(btn, input1);
                                </script>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Tạo</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
