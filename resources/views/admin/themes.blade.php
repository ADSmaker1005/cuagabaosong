<x-app-layout>
    <x-slot name="header">
            {{ __('Themes') }}
    </x-slot>
    
    <form action="{{ route('admin.themes.update') }}" method="POST">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Zalo</label>
                            <input type="text" class="form-control" value="{{ ($themes != null) ? $themes->zalo : ''}}" name="zalo">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Fanpage</label>
                            <input type="text" class="form-control" name="fanpage" value="{{ ($themes != null) ? $themes->fanpage : ''}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Hotline</label>
                            <input type="text" class="form-control" name="hotline" value="{{ ($themes != null) ? $themes->hotline : ''}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" value="{{ ($themes != null) ? $themes->email : ''}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tiktok</label>
                            <input type="text" class="form-control" name="tiktok" value="{{ ($themes != null) ? $themes->tiktok : ''}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Youtube</label>
                            <input type="text" class="form-control" name="youtube" value="{{ ($themes != null) ? $themes->youtube : ''}}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Thêm thẻ SEO h1,h2,h3,h4,h5,h6 ...</label>
                    <textarea id="code" style="display: none;" name="headtag">{!! ($themes != null) ? $themes->headtag : '' !!}</textarea>
                </div>
                <div class="form-group">
                    <label>Thêm code CSS ...</label>
                        <textarea id="code2" style="display: none;" name="css">{!! ($themes != null) ? $themes->css : '' !!}</textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Thẻ title</label>
                    <input type="text" class="form-control" name="title" value="{{ ($themes != null) ? $themes->title : ''}}">
                </div>
                <div class="form-group">
                    <label>Thẻ meta description</label>
                    <input type="text" class="form-control" name="description" value="{{ ($themes != null) ? $themes->description : ''}}">
                </div>
                <div class="form-group">
                    <label>Thẻ keywords</label>
                    <input type="text" class="form-control taginput" data-role="tagsinput" name="keywords" value="{{ ($themes != null) ? $themes->keywords : ''}}">
                </div>
                <div class="form-group">
                    <label>Thêm Schema JS ...</label>
                    <textarea id="code3" style="display: none;" name="schema">{!! ($themes != null) ? $themes->schema : '' !!}</textarea>
                </div>
                <div class="form-group">
                    <label>Logo</label>
                    <div class="input-group">
                        @if (isset($themes))
                            @if ($themes->logo != null)
                                <img src="{{$themes->logo}}" alt="##" id="lfm" data-input="thumbnail">
                            @else
                                <img src="{{asset('images/blank.png')}}" id="lfm" data-input="thumbnail">
                            @endif
                        @endif
                        <input id="thumbnail" class="form-control" type="hidden" name="logo" value="{{ ($themes != null) ? $themes->logo : ''}}">
                      </div>
                </div>
                <div class="form-group">
                    <label>FavIcon</label>
                    <div class="input-group">
                        @if (isset($themes))
                            @if ($themes->favicon != null)
                                <img src="{{$themes->favicon}}" alt="##" id="lfm2" data-input="thumbnail2">
                            @else
                                <img src="{{asset('images/blank.png')}}" id="lfm2" data-input="thumbnail2">
                            @endif
                        @endif

                        <input id="thumbnail2" class="form-control" type="hidden" name="favicon" value="{{ ($themes != null) ? $themes->favicon : ''}}">
                      </div>
                </div>
                {{-- <div class="form-group">
                    <label>Icon</label>
                    <input type="text" class="form-control" name="icon" value="{{ ($themes != null) ? $themes->icon : ''}}">
                </div> --}}
            </div>
        </div>
        <button class="btn btn-xs btn-success" style="position: fixed;bottom:5%;right:5%;z-index:999">Cập nhật</button>
    </form>
    @push('css')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.35.0/codemirror.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://codemirror.net/theme/3024-night.css">
    @endpush
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.59.2/codemirror.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.40.0/mode/javascript/javascript.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/js-beautify/1.10.2/beautify.js"></script>
        <script src="//cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js" type="text/javascript"></script>
        <script>
            $('.taginput').tagsinput('items');
        </script>
        <script>
            $(function() {

                var editorOptions = {
                    autoRefresh: true,
                    firstLineNumber: 1,
                    lineNumbers: true,
                    smartIndent: true,
                    lineWrapping: true,
                    indentWithTabs: true,
                    refresh: true,
                    mode: 'javascript',
                    theme: '3024-night'
                };
                window.onload = function() {
                    CodeMirror.fromTextArea(document.getElementById("code"), editorOptions);
                    CodeMirror.fromTextArea(document.getElementById("code2"), editorOptions);
                    CodeMirror.fromTextArea(document.getElementById("code3"), editorOptions);
                    CodeMirror.fromTextArea(document.getElementById("code4"), editorOptions);
                };
            });
        </script>
        <script>
            var btn = $('#lfm');
            var btn2 = $('#lfm2');
            var btn3 = $('#lfm3');
            var btn4 = $('#lfm4');
            var btn5 = $('#lfm5');
            var input1 = $('#thumbnail');
            var input2 = $('#thumbnail2');
            var input3 = $('#thumbnail3');
            var input4 = $('#thumbnail4');
            var input5 = $('#thumbnail5');
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
            window.Manager(btn2, input2);
            window.Manager(btn3, input3);
            window.Manager(btn4, input4);
            window.Manager(btn5, input5);
        </script>
    @endpush
</x-app-layout>

