<x-app-layout>
    <x-slot name="header">
            {{ __('Form bài viết') }}
    </x-slot>
    <form action="" id="posts_form">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input type="text" class="form-control" id="form--name" value="{{ (isset($posts)) ? $posts->name : '' }}" name="name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Slug</label>
                            <input type="text" class="form-control" id="form--slug" value="{{ (isset($posts)) ? $posts->slug : '' }}" name="slug">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Danh mục</label>
                            <select class="form-control" name="categories[]" id="categories" multiple id="locate">

                                    @if (isset($posts))
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}" @foreach ($posts->Categories as $category){{ ($category->id == $item->id) ? 'selected' : ''}}@endforeach>{{ $item->name }}</option>
                                            @endforeach
                                    @else
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Vị trí</label>
                            <select class="form-control" name="locate" id="locate">
                                <option value="0">---Chọn---</option>
                                <option value="1" {{ isset($posts) ? ($posts->locate =='1' ? 'selected' : '') : '' }}>Trang chủ và chân trang</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tóm tắt</label>
                            <textarea type="text" class="form-control" name="text" id="text">{!! (isset($posts)) ? $posts->text : '' !!}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea type="text" class="form-control content" name="content">{!! (isset($posts)) ? $posts->content : '' !!}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Thẻ title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ (isset($posts)) ? $posts->title : '' }}">
                </div>
                <div class="form-group">
                    <label>Thẻ meta description</label>
                    <input type="text" class="form-control" name="description" id="description" value="{{ (isset($posts)) ? $posts->description : '' }}">
                </div>
                <div class="form-group">
                    <label>Thẻ keywords</label>
                    <input type="text" class="form-control taginput" data-role="tagsinput" name="keywords" id="keywords" value="{{ (isset($posts)) ? $posts->keywords : '' }}">
                </div>
                <div class="form-group">
                    <label>Images</label>
                    <div class="input-group">
                        <img src="{{ (isset($posts)) ? $posts->img : asset('images/blank.png') }}" class="block w-100" alt="img" id="lfm" data-input="thumbnail">
                        <input id="thumbnail" class="form-control" type="hidden" name="img" value="{{ (isset($posts)) ? $posts->img : '' }}">
                      </div>
                </div>
            </div>
        </div>
        <button class="btn btn-xs btn-success" id="form_btn" style="position: fixed;bottom:5%;right:5%;z-index:999">Xác nhận</button>
    </form>
    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    @endpush
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/js-beautify/1.10.2/beautify.js"></script>
        <script src="//cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js" type="text/javascript"></script>
        <!--Wysiwig js-->



        <script>
            $('.taginput').tagsinput('items');
        </script>
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
        @if (isset($posts))
            <script>
                var url = "{{ route('admin.posts.update',$posts->id) }}";
                var type = "POST";
                $('#posts_form').attr('action',url).attr('method','POST')
            </script>
        @else
            <script>
                var url = "{{ route('admin.posts.store') }}";
                var type = "POST";
                $('#posts_form').attr('action',url).attr('method','POST')
            </script>
        @endif
        <script>
            $(document).ready(function() {
                $('#categories').select2();
            });
        </script>

    @endpush
</x-app-layout>

