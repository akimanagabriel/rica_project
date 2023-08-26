<aside class="layout-menu menu-vertical menu bg-menu-theme" id="layout-menu">
    <div class="app-brand demo">
        <a class="app-brand-link" href="index.html">
            <span class="app-brand-logo demo me-1">
                <img alt="" src="{{ asset('assets/logo/lica.jpg') }}" style="height: 20px; border-radius:2px">
            </span>
            <span class="app-brand-text demo menu-text fw-semibold ms-2">lica ms v1</span>
        </a>

        <a class="layout-menu-toggle menu-link text-large ms-auto" href="javascript:void(0);">
            <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        <!-- navigation-->
        <li class="menu-header fw-medium mt-4">
            <span class="menu-header-text">navigation</span>
        </li>

        @if (Auth::user()->level == 'Admin')
            <!-- Dashboards -->
            <li class="menu-item {{ Request::routeIs('home') ? 'active' : '' }}">
                <a class="menu-link" href="{{ route('home') }}">
                    <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                    <div data-i18n="Dashboards">Dashboard</div>
                </a>

            </li>

            <!-- lica academic-->
            <li class="menu-header fw-medium mt-4">
                <span class="menu-header-text">lica academic</span>
            </li>

            <!-- Academy student start -->
            <li class="menu-item {{ Request::routeIs('student') ? 'active' : '' }}">
                <a class="menu-link menu-toggle" href="javascript:void(0);">
                    <i class="menu-icon tf-icons mdi mdi-account-school-outline"></i>
                    <div data-i18n="Student">Student</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item  {{ Request::routeIs('student.create') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('student.create') }}">
                            <div data-i18n="Registration">Registration</div>
                        </a>
                    </li>
                    <li class="menu-item   {{ Request::routeIs('student.index') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('student.index') }}">
                            <div data-i18n="Student List">Student List</div>
                        </a>
                    </li>
                    <li class="menu-item   {{ Request::routeIs('student.alumini') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('student.alumini') }}">
                            <div data-i18n="Alumini">Alumini</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        <!-- Academy menu end -->


        <!-- Academy supervisor start -->
        @if (Auth::user()->level == 'Admin' || Auth::user()->level == 'Supervisor')
            <li class="menu-item">
                <a class="menu-link menu-toggle" href="javascript:void(0);">
                    <i class="menu-icon tf-icons mdi mdi-briefcase-account-outline"></i>
                    <div data-i18n="Supervisor">Supervisor</div>
                </a>

                <ul class="menu-sub   {{ Request::routeIs('assign.index') ? 'active' : '' }}">
                    <li class="menu-item   {{ Request::routeIs('assign.index') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('assign.index') }}">
                            <div data-i18n="Assign LC to Supervisor">Assign LC to Supervisor</div>
                        </a>
                    </li>
                    <li class="menu-item  {{ Request::routeIs('pace.requests.marks') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('pace.requests.marks') }}">
                            <div data-i18n="Pace request & marks">Pace request & marks</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::routeIs('student.results') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('student.results') }}">
                            <div data-i18n="Student Result">Student Result</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        <!-- Academy menu end -->


        <!-- Academy pace store start -->
        @if (Auth::user()->level == 'Admin' || Auth::user()->level == 'Rora')
            <li class="menu-item">
                <a class="menu-link menu-toggle" href="javascript:void(0);">
                    <i class="menu-icon tf-icons mdi mdi-book-open-page-variant-outline"></i>
                    <div data-i18n="Pace Store">Pace Store</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item">
                        <a class="menu-link {{ Request::routeIs('grad.index') ? 'active' : '' }}" href="{{ route('grad.index') }}">
                            <div data-i18n="Pace">Pace</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="app-academy-course.html">
                            <div data-i18n="Pace Purchase">Pace Purchase</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="app-academy-course-details.html">
                            <div data-i18n="Pace Approval">Pace Approval</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="app-academy-course-details.html">
                            <div data-i18n="Pace History">Pace History</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="app-academy-course-details.html">
                            <div data-i18n="Pace Next Store">Pace Next Store</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="app-academy-course-details.html">
                            <div data-i18n="Pace O. School">Pace O. School</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        <!-- Academy pace store end -->


        <!-- setting start -->
        @if (Auth::user()->level == 'Admin')
            <li class="menu-item">
                <a class="menu-link menu-toggle" href="javascript:void(0);">
                    <i class="menu-icon tf-icons mdi mdi-cog-outline"></i>
                    <div data-i18n="Setting">Setting</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item  {{ Request::routeIs('supplier.index') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('supplier.index') }}">
                            <div data-i18n="Pace Supplier">Pace Supplier</div>
                        </a>
                    </li>
                    <li class="menu-item  {{ Request::routeIs('subject.index') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('subject.index') }}">
                            <div data-i18n="Subject">Subject</div>
                        </a>
                    </li>
                    <li class="menu-item   {{ Request::routeIs('grade.index') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('grade.index') }}">
                            <div data-i18n="Grades">Grades</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::routeIs('learning.index') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('learning.index') }}">
                            <div data-i18n="Learning Center">Learning Center</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::routeIs('user.index') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('user.index') }}">
                            <div data-i18n="User List">User List</div>
                        </a>
                    </li>

                </ul>
            </li>
        @endif
        <!-- setting end -->


    </ul>
</aside>
