<x-app-layout>
    <x-slot name="header">
            {{ __('Liên hệ') }}
    </x-slot>
    
    <form action="{{ route('admin.themes.contactUpdate') }}" method="POST">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label>Tiêu đề</label>
                    <input type="text" class="form-control" name="header" value="{{ (isset($contact)) ? $contact->header : '' }}">
                </div>
                <div class="form-group">
                    <label>Tóm tắt</label>
                    <textarea type="text" class="form-control content" name="text">{!! (isset($contact)) ? $contact->text : '' !!}</textarea>
                </div>
                <div class="form-group">
                    <label>Nội dung</label>
                    <textarea type="text" class="form-control content" name="content">{!! (isset($contact)) ? $contact->content : '' !!}</textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Thẻ title</label>
                    <input type="text" class="form-control" name="title" value="{{ (isset($contact)) ? $contact->title : ''}}">
                </div>
                <div class="form-group">
                    <label>Thẻ meta description</label>
                    <input type="text" class="form-control" name="description" value="{{ (isset($contact)) ? $contact->description : ''}}">
                </div>
                <div class="form-group">
                    <label>Thẻ keywords</label>
                    <input type="text" class="form-control taginput" data-role="tagsinput" name="keywords" value="{{ (isset($contact)) ? $contact->keywords : ''}}">
                </div>
                <div class="form-group">
                    <label>Hình nền</label>
                    <div class="input-group">
                                <img src="{{isset($contact) ? $contact->image : asset('images/blank.png')}}" alt="##" id="lfm" data-input="thumbnail">
                        <input id="thumbnail" class="form-control" type="hidden" name="image" value="{{ (isset($contact)) ? $contact->image : ''}}">
                      </div>
                </div>
            </div>
        </div>
        <button class="btn btn-xs btn-success" style="position: fixed;bottom:5%;right:5%;z-index:999">Cập nhật</button>
    </form>
    @push('css')
    @endpush
    @push('scripts')
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

