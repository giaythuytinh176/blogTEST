<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <!-- Sidenav Menu Heading (Account)-->
            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
            <div class="sidenav-menu-heading d-sm-none">Account</div>
            <!-- Sidenav Link (Alerts)-->
            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
            <a class="nav-link d-sm-none" href="#!">
                <div class="nav-link-icon"><i data-feather="bell"></i></div>
                Alerts
                <span class="badge badge-warning-soft text-warning ml-auto">4 New!</span>
            </a>
            <!-- Sidenav Link (Messages)-->
            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
            <a class="nav-link d-sm-none" href="#!">
                <div class="nav-link-icon"><i data-feather="mail"></i></div>
                Messages
                <span class="badge badge-success-soft text-success ml-auto">2 New!</span>
            </a>
            <!-- Sidenav Menu Heading (Core)-->
        {{--            <div class="sidenav-menu-heading">Core</div>--}}
        <!-- Sidenav Accordion (Dashboard)-->
        {{--            <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">--}}
        {{--                <div class="nav-link-icon"><i data-feather="activity"></i></div>--}}
        {{--                Dashboards--}}
        {{--                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>--}}
        {{--            </a>--}}
        {{--            <div class="collapse" id="collapseDashboards" data-parent="#accordionSidenav">--}}
        {{--                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">--}}
        {{--                    <a class="nav-link" href="{{ route('admin.index') }}">--}}
        {{--                        Default--}}
        {{--                        <span class="badge badge-primary-soft text-primary ml-auto">Updated</span>--}}
        {{--                    </a>--}}
        {{--                    <a class="nav-link" href="dashboard-2.html">Multipurpose</a>--}}
        {{--                    <a class="nav-link" href="dashboard-3.html">Affiliate</a>--}}
        {{--                </nav>--}}
        {{--            </div>--}}
        <!-- Sidenav Heading (App Views)-->
            <div class="sidenav-menu-heading">App Views</div>
            <!-- Sidenav Accordion (Pages)-->
            <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                <div class="nav-link-icon"><i data-feather="grid"></i></div>
                Posts
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePages" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                    <a class="nav-link" href="{{ route('admin.index') }}">All Posts</a>
                    <a class="nav-link" href="{{ route('admin.create') }}">Add New</a>

                </nav>
            </div>
        </div>
    </div>
    <!-- Sidenav Footer-->
    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Logged in as:</div>
            <div class="sidenav-footer-title">
                {{ \Illuminate\Support\Facades\Auth::user()->email }}
            </div>
            <div>
                {{ \Illuminate\Support\Facades\Auth::user()->role == 1 ? 'You are admin.' : '' }}
            </div>
        </div>
    </div>
</nav>
