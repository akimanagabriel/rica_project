<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="mdi mdi-menu mdi-24px"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item navbar-search-wrapper mb-0">
                <a class="nav-item nav-link search-toggler fw-normal px-0" href="javascript:void(0);">
                    <i class="mdi mdi-magnify mdi-24px scaleX-n1-rtl"></i>
                    <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
                </a>
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">

            <!-- Style Switcher -->
            <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                <a class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
                    href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="mdi mdi-24px"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                            <span class="align-middle"><i class="mdi mdi-weather-sunny me-2"></i>Light</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                            <span class="align-middle"><i class="mdi mdi-weather-night me-2"></i>Dark</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                            <span class="align-middle"><i class="mdi mdi-monitor me-2"></i>System</span>
                        </a>
                    </li>
                </ul>
                <!-- / Style Switcher-->

                <!-- Quick links  -->
            </li>

            <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-1 me-xl-0">
                <a class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
                    href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                    aria-expanded="false">
                    <i class="mdi mdi-view-grid-outline mdi-24px"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end py-0">
                    <div class="dropdown-menu-header border-bottom">
                        <div class="dropdown-header d-flex align-items-center py-3">
                            <h6 class="mb-0 me-auto">Shortcuts</h6>
                            <a href="javascript:void(0)" class="dropdown-shortcuts-add text-heading"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Add shortcuts"><i
                                    class="mdi mdi-plus mdi-24px"></i></a>
                        </div>
                    </div>
                    <div class="dropdown-shortcuts-list scrollable-container">
                        <div class="row row-bordered overflow-visible g-0">
                            <div class="dropdown-shortcuts-item col">
                                <span
                                    class="dropdown-shortcuts-icon bg-label-secondary text-heading rounded-circle mb-3">
                                    <i class="mdi mdi-calendar-blank mdi-24px"></i>
                                </span>
                                <a href="app-calendar.html" class="stretched-link">Calendar</a>
                                <small>Appointments</small>
                            </div>
                            <div class="dropdown-shortcuts-item col">
                                <span
                                    class="dropdown-shortcuts-icon bg-label-secondary text-heading rounded-circle mb-3">
                                    <i class="mdi mdi mdi-content-paste mdi-24px"></i>
                                </span>
                                <a href="app-invoice-list.html" class="stretched-link">Invoice App</a>
                                <small>Manage Accounts</small>
                            </div>
                        </div>
                        <div class="row row-bordered overflow-visible g-0">
                            <div class="dropdown-shortcuts-item col">
                                <span
                                    class="dropdown-shortcuts-icon bg-label-secondary text-heading rounded-circle mb-3">
                                    <i class="mdi mdi-account-outline mdi-24px"></i>
                                </span>
                                <a href="app-user-list.html" class="stretched-link">User App</a>
                                <small>Manage Users</small>
                            </div>
                            <div class="dropdown-shortcuts-item col">
                                <span
                                    class="dropdown-shortcuts-icon bg-label-secondary text-heading rounded-circle mb-3">
                                    <i class="mdi mdi-shield-check-outline mdi-24px"></i>
                                </span>
                                <a href="app-access-roles.html" class="stretched-link">Role
                                    Management</a>
                                <small>Permission</small>
                            </div>
                        </div>
                        <div class="row row-bordered overflow-visible g-0">
                            <div class="dropdown-shortcuts-item col">
                                <span
                                    class="dropdown-shortcuts-icon bg-label-secondary text-heading rounded-circle mb-3">
                                    <i class="mdi mdi-monitor mdi-24px"></i>
                                </span>
                                <a href="index.html" class="stretched-link">Dashboard</a>
                                <small>User Profile</small>
                            </div>
                            <div class="dropdown-shortcuts-item col">
                                <span
                                    class="dropdown-shortcuts-icon bg-label-secondary text-heading rounded-circle mb-3">
                                    <i class="mdi mdi-cog-outline mdi-24px"></i>
                                </span>
                                <a href="pages-account-settings-account.html" class="stretched-link">Setting</a>
                                <small>Account Settings</small>
                            </div>
                        </div>
                        <div class="row row-bordered overflow-visible g-0">
                            <div class="dropdown-shortcuts-item col">
                                <span
                                    class="dropdown-shortcuts-icon bg-label-secondary text-heading rounded-circle mb-3">
                                    <i class="mdi mdi-help-circle-outline mdi-24px"></i>
                                </span>
                                <a href="pages-help-center-landing.html" class="stretched-link">Help
                                    Center</a>
                                <small>FAQs & Articles</small>
                            </div>
                            <div class="dropdown-shortcuts-item col">
                                <span
                                    class="dropdown-shortcuts-icon bg-label-secondary text-heading rounded-circle mb-3">
                                    <i class="mdi mdi-dock-window mdi-24px"></i>
                                </span>
                                <a href="modal-examples.html" class="stretched-link">Modals</a>
                                <small>Useful Popups</small>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <!-- Quick links -->

            <!-- Notification -->
            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-2 me-xl-1">
                <a class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
                    href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                    aria-expanded="false">
                    <i class="mdi mdi-bell-outline mdi-24px"></i>
                    <span
                        class="position-absolute top-0 start-50 translate-middle-y badge badge-dot bg-danger mt-2 border"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end py-0">
                    <li class="dropdown-menu-header border-bottom">
                        <div class="dropdown-header d-flex align-items-center py-3">
                            <h6 class="fw-normal mb-0 me-auto">Notification</h6>
                            <span class="badge rounded-pill bg-label-primary">8 New</span>
                        </div>
                    </li>
                    <li class="dropdown-notifications-list scrollable-container">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="flex-shrink-0">
                                        <div class="avatar me-1">
                                            <img src="../../assets/img/avatars/1.png" alt
                                                class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1 overflow-hidden w-px-250">
                                        <h6 class="mb-1 text-truncate">Congratulation Lettie 🎉</h6>
                                        <small class="text-truncate text-body">Won the monthly best
                                            seller gold badge</small>
                                    </div>
                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                        <small class="text-muted">1h ago</small>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="flex-shrink-0">
                                        <div class="avatar me-1">
                                            <span class="avatar-initial rounded-circle bg-label-danger">CF</span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1 overflow-hidden w-px-250">
                                        <h6 class="mb-1 text-truncate">Charles Franklin</h6>
                                        <small class="text-truncate text-body">Accepted your
                                            connection</small>
                                    </div>
                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                        <small class="text-muted">12hr ago</small>
                                    </div>
                                </div>
                            </li>
                            <li
                                class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="flex-shrink-0">
                                        <div class="avatar me-1">
                                            <img src="../../assets/img/avatars/2.png" alt
                                                class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1 overflow-hidden w-px-250">
                                        <h6 class="mb-1 text-truncate">New Message ✉️</h6>
                                        <small class="text-truncate text-body">You have new message
                                            from Natalie</small>
                                    </div>
                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                        <small class="text-muted">1h ago</small>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="flex-shrink-0">
                                        <div class="avatar me-1">
                                            <span class="avatar-initial rounded-circle bg-label-success"><i
                                                    class="mdi mdi-cart-outline"></i></span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1 overflow-hidden w-px-250">
                                        <h6 class="mb-1 text-truncate">Whoo! You have new order 🛒</h6>
                                        <small class="text-truncate text-body">ACME Inc. made new order
                                            $1,154</small>
                                    </div>
                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                        <small class="text-muted">1 day ago</small>
                                    </div>
                                </div>
                            </li>
                            <li
                                class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="flex-shrink-0">
                                        <div class="avatar me-1">
                                            <img src="../../assets/img/avatars/9.png" alt
                                                class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1 overflow-hidden w-px-250">
                                        <h6 class="mb-1 text-truncate">Application has been approved 🚀
                                        </h6>
                                        <small class="text-truncate text-body">Your ABC project
                                            application has been approved.</small>
                                    </div>
                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                        <small class="text-muted">2 days ago</small>
                                    </div>
                                </div>
                            </li>
                            <li
                                class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="flex-shrink-0">
                                        <div class="avatar me-1">
                                            <span class="avatar-initial rounded-circle bg-label-success"><i
                                                    class="mdi mdi-chart-pie-outline"></i></span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1 overflow-hidden w-px-250">
                                        <h6 class="mb-1 text-truncate">Monthly report is generated</h6>
                                        <small class="text-truncate text-body">July monthly financial
                                            report is generated </small>
                                    </div>
                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                        <small class="text-muted">3 days ago</small>
                                    </div>
                                </div>
                            </li>
                            <li
                                class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="flex-shrink-0">
                                        <div class="avatar me-1">
                                            <img src="../../assets/img/avatars/5.png" alt
                                                class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1 overflow-hidden w-px-250">
                                        <h6 class="mb-1 text-truncate">Send connection request</h6>
                                        <small class="text-truncate text-body">Peter sent you
                                            connection request</small>
                                    </div>
                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                        <small class="text-muted">4 days ago</small>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="flex-shrink-0">
                                        <div class="avatar me-1">
                                            <img src="../../assets/img/avatars/6.png" alt
                                                class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1 overflow-hidden w-px-250">
                                        <h6 class="mb-1 text-truncate">New message from Jane</h6>
                                        <small class="text-truncate text-body">Your have new message
                                            from Jane</small>
                                    </div>
                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                        <small class="text-muted">5 days ago</small>
                                    </div>
                                </div>
                            </li>
                            <li
                                class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="flex-shrink-0">
                                        <div class="avatar me-1">
                                            <span class="avatar-initial rounded-circle bg-label-warning"><i
                                                    class="mdi mdi-alert-circle-outline"></i></span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1 overflow-hidden w-px-250">
                                        <h6 class="mb-1">CPU is running high</h6>
                                        <small class="text-truncate text-body">CPU Utilization Percent
                                            is currently at 88.63%,</small>
                                    </div>
                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                        <small class="text-muted">5 days ago</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown-menu-footer border-top p-3">
                        <a href="javascript:void(0);" class="btn btn-primary d-flex justify-content-center">Read all
                            notifications</a>
                    </li>
                </ul>
            </li>
            <!--/ Notification -->

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <div class="avatar avatar-sm avatar-online">
                        <span class="avatar-initial rounded-circle bg-primary">{{ Auth::user()->name[0] }}</span>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
                    <li>
                        <a class="dropdown-item pb-2 mb-1" href="{{ route('user.accountSetting') }}">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-md me-2 avatar-online">
                                    <span class="avatar-initial rounded-circle bg-primary">{{ Auth::user()->name[0] }}</span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">{{ Auth::user()->username }}</h6>
                                    <small class="text-muted">{{ Auth::user()->email }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider my-0"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('user.accountSetting') }}">
                            <i class="mdi mdi-account-outline me-1 mdi-20px"></i>
                            <span class="align-middle">My Account</span>
                        </a>
                    </li>

                    <li>
                        <div class="dropdown-divider my-1"></div>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            <div>
                                @csrf
                                <button class="dropdown-item">
                                    <i class="mdi mdi-logout me-1 mdi-20px"></i>
                                    <span class="align-middle">Log Out</span>
                                </button>
                            </div>
                        </form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>

    <!-- Search Small Screens -->
    <div class="navbar-search-wrapper search-input-wrapper d-none">
        <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..."
            aria-label="Search..." />
        <i class="mdi mdi-close search-toggler cursor-pointer"></i>
    </div>
</nav>
