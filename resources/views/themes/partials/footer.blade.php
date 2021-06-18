<footer>
    <div class="container">
        <div class="footer-top">
            <div class="footer-top__header">
                {{ $footer->header1 }}
            </div>
            {!! $footer->content1 !!}
        </div>
        <div class="footer-border"></div>
        <div class="footer-bottom">
            <div class="footer-bottom__header">
                {{ $footer->header2 }}
            </div>
            <div style="overflow: auto">
                {!! $footer->content2 !!}
            </div>
        </div>
    </div>
    <div class="footer-info">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="footer-info--header">
                        {!! $footer->header3 !!}
                    </div>
                    <div class="footer-info--text">
                        {!! $footer->content3 !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-info--header">
                       DỊCH VỤ
                    </div>
                    <div class="footer-info--text">
                        @foreach ($FooterCategories->where('type','0')->where('locate','1') as $category)
                        <a href="{{ url($category->slug.'?type='.$category->type)}}" class="footer-info--link">
                            {{ $category->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-info--header">
                        {!! $footer->header4 !!}
                    </div>
                    <div class="footer-info--text">
                        {!! $footer->content4 !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-info--header">
                        {!! $footer->header5 !!}
                    </div>
                    <div class="footer-info--text">
                        {!! $footer->content5 !!}
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
</footer>