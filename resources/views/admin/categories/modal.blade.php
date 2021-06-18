<div class="modal fade bs-example-modal-lg" id="categories_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Thêm Categories</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="form_categories">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Thẻ title</label>
                                        <input type="text" class="form-control" name="title" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Thẻ meta description</label>
                                        <input type="text" class="form-control" name="description" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Thẻ keywords</label>
                                        <input type="text" class="form-control taginput" data-role="tagsinput" name="keywords" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Thứ tự</label>
                                        <input type="number" value="0" class="form-control" min="0" name="sort_id">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Loại danh mục</label>
                                        <select class="form-control" name="type">
                                            <option value="0">
                                                Bài viết
                                            </option>
                                            <option value="1">
                                                Sản phẩm
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Categories</label>
                                        <input type="text" class="form-control" id="form--name" name="name">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Slug</label>
                                        <input type="text" class="form-control" id="form--slug" name="slug">
                                    </div>
                                </div>
                                <script>
                                    $('#form--name').keyup(function(){
                                        var title =$(this).val();
                                        slug = title.toLowerCase();

                                        //Đổi ký tự có dấu thành không dấu
                                        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                                        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                                        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                                        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                                        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                                        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                                        slug = slug.replace(/đ/gi, 'd');
                                        //Xóa các ký tự đặt biệt
                                        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                                        //Đổi khoảng trắng thành ký tự gạch ngang
                                        slug = slug.replace(/ /gi, "-");
                                        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                                        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                                        slug = slug.replace(/\-\-\-\-\-/gi, '-');
                                        slug = slug.replace(/\-\-\-\-/gi, '-');
                                        slug = slug.replace(/\-\-\-/gi, '-');
                                        slug = slug.replace(/\-\-/gi, '-');
                                        //Xóa các ký tự gạch ngang ở đầu và cuối
                                        slug = '@' + slug + '@';
                                        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                                        $('#form--slug').val(slug);
                                    });
                                </script>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Vị trí</label>
                                        <select class="form-control" name="locate">
                                            <option value="0">
                                                == Không ==
                                            </option>
                                            <option value="1">
                                                Deal sốc(bài viết)
                                            </option>
                                            <option value="2">
                                                Danh mục(sản phẩm)
                                            </option>
                                            <option value="3">
                                                Danh mục kèm sản phẩm(sản phẩm)
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Hiện trang chủ</label>
                                        <input class="form-control" type="checkbox" name="showindex" value="1">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Icon</label>
                                        <input type="text" name="icon" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tóm tắt</label>
                                        <textarea class="form-control" name="text"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <div class="input-group">
                                    <img src="{{ asset('images/blank.png') }}" class="block w-100" style="height: 200px" id="lfm" data-input="thumbnail">
                                    <input id="thumbnail" class="form-control" type="hidden" name="image">
                                </div>
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
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea class="content" name="area"></textarea>
                    </div>
                    <button class="btn btn-success" type="submit">Tạo</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
