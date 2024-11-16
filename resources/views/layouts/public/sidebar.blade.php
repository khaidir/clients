<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: false, lg: true}" data-kt-sticky-name="app-header-sticky" data-kt-sticky-offset="{default: false, lg: '300px'}">
    <div class="app-container container-xxl d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
        <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show sidebar menu">
            <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_header_menu_toggle">
                <i class="ki-outline ki-abstract-14 fs-2"></i>
            </div>
        </div>
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 me-lg-18">
            <a href="">
            <img alt="Logo" src="#" class="h-25px d-sm-none" />
            <img alt="Logo" src="{{ asset('assets/images/logo2.png') }}" class="w-100px w-70px d-none d-sm-block" />
            </a>
        </div>
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
            <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                <div class="menu menu-rounded menu-active-bg menu-state-primary menu-column menu-lg-row menu-title-gray-700 menu-icon-gray-500 menu-arrow-gray-500 menu-bullet-gray-500 my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0" id="kt_app_header_menu" data-kt-menu="true">
                    <div class="menu-item {{ request()->is('user') ? 'here show' : '' }} menu-lg-down-accordion me-0 me-lg-2">
                        <span class="menu-link">
                        <a href="/"><span class="menu-title">Home</span></a>
                        </span>
                    </div>
                    <div class="menu-item {{ request()->is('company') ? 'here show' : '' }} menu-here-bg menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                        <span class="menu-link">
                        <a href="/u/contracts">
                            <span class="menu-title">New Worker Access</span></a>
                        </span>
                    </div>
                    <div class="menu-item {{ request()->is('company') ? 'here show' : '' }} menu-here-bg menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                        <span class="menu-link">
                        <a href="/u/extended">
                            <span class="menu-title">Extend Periode</span></a>
                        </span>
                    </div>
                    <div class="menu-item {{ request()->is('company') ? 'here show' : '' }} menu-here-bg menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                        <span class="menu-link">
                        <a href="/u/history">
                            <span class="menu-title">History</span></a>
                        </span>
                    </div>
                    <div class="menu-item {{ request()->is('landing/faq') ? 'here show' : '' }} menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                        <span class="menu-link">
                        <a href="">
                        <span class="menu-title">FAQ</span></a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="app-navbar flex-shrink-0">
                <div class="app-navbar-item ms-5" id="kt_header_user_menu_toggle">
                    <div class="cursor-pointer symbol symbol-35px symbol-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <img class="symbol symbol-circle symbol-35px symbol-md-40px" src="{{ asset('assets/landing/media/avatars/blank.png') }}" alt="user" />
                    </div>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <div class="symbol symbol-50px me-5">
                                    <img alt="Logo" src="{{ asset('assets/landing/media/avatars/blank.png') }}" />
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-5">{{ auth()->user()->name }}
                                        <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Online</span>
                                    </div>
                                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{ auth()->user()->email }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="separator my-2"></div>
                        <div class="menu-item px-5">
                            <a href="/u/profile" class="menu-link px-5">My Profile</a>
                        </div>
                        <div class="menu-item px-5 my-1">
                            <a href="/u/company" class="menu-link px-5">Account Settings</a>
                        </div>
                        <div class="menu-item px-5 my-1">
                            <a href="/u/contact" class="menu-link px-5">Contact</a>
                        </div>
                        <div class="menu-item px-5 my-1">
                            <a href="/u/about" class="menu-link px-5">About</a>
                        </div>
                        <div class="separator my-2"></div>
                        <div class="menu-item px-5">
                            <a href="{{ url('logout') }}" class="menu-link px-5">Sign Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
