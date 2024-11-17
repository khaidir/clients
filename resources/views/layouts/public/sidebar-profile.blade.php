<div class="cards card-flush py-4">
    <div class="card-bodys">
        <div class="menu menu-column menu-rounded menu-state-bg menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary mb-10">
            <div class="menu-item mb-3">
                <a href="/u/profile" class="text-dark">
                    <span class="menu-link {{ request()->is('u/profile') ? 'active' : '' }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-user fs-2 me-3">
                                <span class="path1"></span><span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title fw-bold">Profiles</span>
                    </span>
                </a>
            </div>
            <div class="menu-item mb-3">
                <a href="/u/company" class="text-dark">
                    <span class="menu-link {{ request()->is('u/company') ? 'active' : '' }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-abstract-23 fs-2 me-3">
                                <span class="path1"></span><span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title fw-bold">My Company</span>
                    </span>
                </a>
            </div>
            <div class="menu-item mb-3">
                <a href="/u/notification" class="text-dark">
                    <span class="menu-link {{ request()->is('u/notification') ? 'active' : '' }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-sms fs-2 me-3">
                                <span class="path1"></span><span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title fw-bold">Notification</span>
                        <span class="badge badge-light-success">5</span>
                    </span>
                </a>
            </div>
            <div class="menu-item mb-3">
                <a href="/u/history" class="text-dark">
                    <span class="menu-link {{ request()->is('u/history') ? 'active' : '' }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-send fs-2 me-3">
                                <span class="path1"></span><span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title fw-bold">History</span>
                        <span class="badge badge-light-warning">soon</span>
                    </span>
                </a>
            </div>
            <div class="menu-item">
                <a href="/u/log" class="text-dark">
                    <span class="menu-link {{ request()->is('u/log') ? 'active' : '' }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-trash fs-2 me-3">
                                <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                                <span class="path4"></span><span class="path5"></span>
                            </i>
                        </span>
                        <span class="menu-title fw-bold">Log</span>
                        <span class="badge badge-light-warning">soon</span>
                    </span>
                </a>
            </div>
        </div>

        <div class="menu menu-column menu-rounded menu-state-bg menu-state-title-primary">
            <div class="menu-item mb-3">
                <a href="/u/contact" class="text-dark">
                    <span class="menu-link {{ request()->is('u/contact') ? 'active' : '' }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-abstract-8 fs-5 text-danger me-3 lh-0">
                                <span class="path1"></span><span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title fw-semibold">Contact</span>
                    </span>
                </a>
            </div>
            <div class="menu-item mb-3">
                <a href="/u/about" class="text-dark">
                    <span class="menu-link {{ request()->is('u/about') ? 'active' : '' }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-abstract-8 fs-5 text-success me-3 lh-0">
                                <span class="path1"></span><span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title fw-semibold">About</span>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
