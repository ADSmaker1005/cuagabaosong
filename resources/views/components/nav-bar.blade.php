<!-- MENU Start -->
<div class="navbar-custom">
    <div class="container-fluid">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">

                <li class="has-submenu">
                    <x-jet-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                        <i class="dripicons-device-desktop"></i>{{ __('Trang chủ') }}
                    </x-jet-nav-link>
                </li>
                @if (Auth::user()->Role->first()->role_id == "1" || Auth::user()->Role->first()->role_id == "2")
                    <li class="has-submenu">
                        <a href="#"><i class="dripicons-suitcase"></i>Hệ thống <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                        <ul class="submenu megamenu">
                            <li>
                                <ul>
                                    <li><a href="{{ route('admin.themes.index') }}">Giao diện</a></li>
                                    <li><a href="{{ route('admin.themes.contact') }}">Liên hệ</a></li>
                                    <li><a href="{{ route('admin.footer.index') }}">Footer</a></li>
                                    <li><a href="{{ route('admin.banner.index') }}">Banner</a></li>
                                    <li><a href="{{ route('admin.filemanager.index') }}">Thư viện &amp; Hình ảnh</a></li>
                                    <li><a href="{{ route('admin.partner.index') }}">Đối tác</a></li>
                                    <li><a href="{{ route('admin.ghtk-option.index') }}">Cài đặt GHTK</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->Role->first()->role_id == "1" || Auth::user()->Role->first()->role_id == "2")
                    <li class="has-submenu">
                        <a href="#"><i class="dripicons-suitcase"></i>Danh mục <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                        <ul class="submenu megamenu">
                            <li>
                                <ul>
                                    <li><a href="{{ route('admin.categories.index') }}">Danh sách</a></li>
                                    <li><a href="{{ route('admin.categories.sort.index') }}">Sắp xếp</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->Role->first()->role_id == "1" || Auth::user()->Role->first()->role_id == "2")
                    <li class="has-submenu">
                        <a href="#"><i class="dripicons-suitcase"></i>Bài viết <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                        <ul class="submenu megamenu">
                            <li>
                                <ul>
                                    <li><a href="{{ route('admin.posts.index') }}">Danh sách</a></li>
                                    <li><a href="{{ route('admin.posts.create') }}">Tạo bài viết</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->Role->first()->role_id == "1" || Auth::user()->Role->first()->role_id == "3")
                <li class="has-submenu">
                    <a href="#"><i class="dripicons-suitcase"></i>Khách hàng<i class="mdi mdi-chevron-down mdi-drop"></i></a>
                    <ul class="submenu megamenu">
                        <li>
                            <ul>
                                <li><a href="{{ route('admin.form.index') }}">Danh sách phản hồi</a></li>
                                <li><a href="{{ route('admin.form.cart.index') }}">Đơn đặt hàng</a></li>
                                <li>
                                    <a href="{{ route('admin.customer.index') }}">Danh sách khách hàng</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                @endif
                @if (Auth::user()->Role->first()->role_id == "1" || Auth::user()->Role->first()->role_id == "2")
                <li class="has-submenu">
                    <a href="#"><i class="mdi mdi-archive"></i>Sản phẩm <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                    <ul class="submenu megamenu">
                        <li>
                            <ul>
                                <li><a href="{{ route('admin.products.index') }}">Danh sách</a></li>
                                <li><a href="{{ route('admin.products.create') }}">Tạo sản phẩm</a></li>
                                <li><a href="{{ route('admin.products.options.categories') }}">Danh mục chức năng</a></li>
                                <li><a href="{{ route('admin.products.options.list') }}">Danh sách chức năng</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                @endif
                @if (Auth::user()->Role->first()->role_id == "1" )
                    <li class="has-submenu">
                        <a href="#"><i class="mdi mdi-archive"></i>Cài đặt <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                        <ul class="submenu megamenu">
                            <li>
                                <ul>
                                    <li><a href="{{ route('admin.user.index') }}">Người dùng</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
            <!-- End navigation menu -->
        </div> <!-- end #navigation -->
    </div> <!-- end container -->
</div> <!-- end navbar-custom -->
