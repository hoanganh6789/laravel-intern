<div data-simplebar class="h-100">
    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title" key="t-menu">Dashboards</li>


            <li>
                <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                    <i class="bx bx-home-circle"></i>
                    <span key="t-chat">Dashboards</span>
                </a>
            </li>

            <li>
                <a href="javascript: void(0);" class="waves-effect">
                    <span class="badge rounded-pill bg-danger float-end" key="t-hot">Hot</span>
                    <i class="bx bx-layout"></i>
                    <span key="t-layouts">Layouts</span>
                </a>
                <ul class="sub-menu" aria-expanded="true">
                    <li>
                        <a href="javascript: void(0);" class="has-arrow" key="t-vertical">Vertical</a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="layouts-light-sidebar.html" key="t-light-sidebar">Light Sidebar</a>
                            </li>
                            <li><a href="layouts-compact-sidebar.html" key="t-compact-sidebar">Compact
                                    Sidebar</a></li>
                            <li><a href="layouts-icon-sidebar.html" key="t-icon-sidebar">Icon Sidebar</a>
                            </li>
                            <li><a href="layouts-boxed.html" key="t-boxed-width">Boxed Width</a></li>
                            <li><a href="layouts-preloader.html" key="t-preloader">Preloader</a></li>
                            <li><a href="layouts-colored-sidebar.html" key="t-colored-sidebar">Colored
                                    Sidebar</a></li>
                            <li><a href="layouts-scrollable.html" key="t-scrollable">Scrollable</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow" key="t-horizontal">Horizontal</a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="layouts-horizontal.html" key="t-horizontal">Horizontal</a></li>
                            <li><a href="layouts-hori-topbar-light.html" key="t-topbar-light">Topbar
                                    light</a></li>
                            <li><a href="layouts-hori-boxed-width.html" key="t-boxed-width">Boxed width</a>
                            </li>
                            <li><a href="layouts-hori-preloader.html" key="t-preloader">Preloader</a></li>
                            <li><a href="layouts-hori-colored-header.html" key="t-colored-topbar">Colored
                                    Header</a></li>
                            <li><a href="layouts-hori-scrollable.html" key="t-scrollable">Scrollable</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="menu-title" key="t-administration">Administration</li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="bx bx-receipt"></i>
                    <span key="t-maps">Categories</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li class="{{ activeMenuLi('admin/categories') }}">
                        <a href="{{ route('admin.categories.index') }}" key="t-g-categories">
                            Categories
                        </a>
                    </li>
                    <li class="{{ activeMenuLi('admin/sub-categories') }}">
                        <a href="{{ route('admin.sub-categories.index') }}" key="t-v-maps" class="{{ activeMenu('admin/sub-categories') }}">
                            SubCategories
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ activeMenuLi('admin/users') }}">
                <a href="{{ route('admin.users.index') }}" class="waves-effect {{ activeMenu('admin/users') }}">
                    <i class="bx bx-user"></i>
                    <span key="t-users">Users</span>
                </a>
            </li>

            {{-- <li class="{{ activeMenuLi('admin/products') }}">
            <a href="{{ route('admin.products.index') }}" class="waves-effect">
                <i class="bx bx-receipt"></i>
                <span key="t-products">Products</span>
            </a>
            </li> --}}

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="bx bx-share-alt"></i>
                    <span key="t-multi-level">Products</span>
                </a>
                <ul class="sub-menu" aria-expanded="true">
                    <li>
                        <a href="{{ route('admin.products.index') }}" key="t-level-1-1">
                            List Product
                        </a>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow" key="t-level-1-2">Variants</a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="{{ route('admin.product-colors.index') }}" key="t-level-2-1">Colors</a></li>
                            <li><a href="{{ route('admin.product-sizes.index') }}" key="t-level-2-2">Sizes</a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="{{ activeMenuLi('admin/comments') }}">
                <a href="{{ route('admin.comments.index') }}" class="waves-effect">
                    <i class="bx bx-receipt"></i>
                    <span key="t-comments">Comments</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.orders.index') }}" class="waves-effect">
                    <i class="bx bx-receipt"></i>
                    <span key="t-orders">Orders</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.flash-sales.index') }}" class="waves-effect">
                    <i class="bx bx-receipt"></i>
                    <span key="t-flash-sale">Flash Sale</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.coupons.index') }}" class="waves-effect">
                    <i class="bx bx-receipt"></i>
                    <span key="t-coupons">Coupons</span>
                </a>
            </li>

            <li class="menu-title" key="t-settings">Settings</li>

            <li>
                <a href="{{ route('admin.banner.index') }}" class="waves-effect">
                    <i class="bx bx-receipt"></i>
                    <span key="t-banner">Banner</span>
                </a>
            </li>


            <li>
                <a href="{{ route('admin.menus.index') }}" class="waves-effect">
                    <i class="bx bx-receipt"></i>
                    <span key="t-menu">Menu</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- Sidebar -->
</div>
