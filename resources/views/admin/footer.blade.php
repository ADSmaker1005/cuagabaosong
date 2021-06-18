<x-app-layout>
    <x-slot name="header">
            {{ __('Footer') }}
    </x-slot>
    @push('css')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.35.0/codemirror.css" rel="stylesheet" />
        <link rel="stylesheet" href="http://codemirror.net/theme/3024-night.css">
    @endpush
    <form action="{{ route('admin.footer.update') }}" method="POST">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tiêu đề chân trang</label>
                            <input type="text" class="form-control"   name="header1"  value="{{ ($footer != null) ? $footer->header1 : ''}}">
                        </div>
                        <div class="form-group">
                            <label>Nội dung chân trang</label>
                            <textarea name="content1" class="content">{!! ($footer != null) ? $footer->content1 : '' !!}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tiêu đề chân trang 2</label>
                            <input type="text" class="form-control"   name="header2"  value="{{ ($footer != null) ? $footer->header2 : ''}}">
                        </div>
                        <div class="form-group">
                            <label>Nội dung chân trang 2</label>
                            <textarea name="content2" class="content">{!! ($footer != null) ? $footer->content2 : '' !!}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tiêu đề chân trang 3</label>
                            <input type="text" class="form-control"   name="header3"  value="{{ ($footer != null) ? $footer->header3 : ''}}">
                        </div>
                        <div class="form-group">
                            <label>Nội dung chân trang 3</label>
                            <textarea name="content3" class="content">{!! ($footer != null) ? $footer->content3 : '' !!}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tiêu đề chân trang 4</label>
                            <input type="text" class="form-control"   name="header4"  value="{{ ($footer != null) ? $footer->header4 : ''}}">
                        </div>
                        <div class="form-group">
                            <label>Nội dung chân trang 4</label>
                            <textarea name="content4" class="content">{!! ($footer != null) ? $footer->content4 : '' !!}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tiêu đề chân trang 5</label>
                            <input type="text" class="form-control"   name="header5"  value="{{ ($footer != null) ? $footer->header5 : ''}}">
                        </div>
                        <div class="form-group">
                            <label>Nội dung chân trang 5</label>
                            <textarea name="content5" class="content">{!! ($footer != null) ? $footer->content5 : '' !!}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-xs btn-success" style="position: fixed;bottom:5%;right:5%;z-index:999">Cập nhật</button>
    </form>
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/js-beautify/1.10.2/beautify.js"></script>
        <script src="//cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js" type="text/javascript"></script>

    @endpush
</x-app-layout>

