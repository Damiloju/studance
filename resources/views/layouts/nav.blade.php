<header id="topnav">
    <div class="topbar-main">
        <div class="container-fluid">

            <!-- Logo container-->
            <div class="logo">
                {{--<a href="index.html" class="logo">--}}
                {{--<span class="logo-small"><i class="mdi mdi-radar"></i></span>--}}
                {{--<span class="logo-large"><i class="mdi mdi-radar"></i> McPherson</span>--}}
                {{--</a>--}}
                <!-- Image Logo -->
                <a href="index.html" class="logo" style="padding-top: 18px">
                    <img src="/template/assets/images/logo-sm.png" alt="" height="26" class="logo-small">
                    <img src="/template/assets/images/logo.png" alt="" height="24" class="logo-large">
                </a>

            </div>
            <!-- End Logo container-->


            <div class="menu-extras topbar-custom">

                <ul class="list-unstyled topbar-right-menu float-right mb-0">

                    <li class="menu-item">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle nav-link">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li>
                    <li class="hide-phone">
                        <form class="app-search">
                            <input type="text" placeholder="Search..."
                                   class="form-control">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </li>
                    {{--<li>--}}
                        {{--<!-- Notification -->--}}
                        {{--<div class="notification-box">--}}
                            {{--<ul class="list-inline mb-0">--}}
                                {{--<li>--}}
                                    {{--<a href="javascript:void(0);" class="right-bar-toggle">--}}
                                        {{--<i class="mdi mdi-bell-outline noti-icon"></i>--}}
                                    {{--</a>--}}
                                    {{--<div class="noti-dot">--}}
                                        {{--<span class="dot"></span>--}}
                                        {{--<span class="pulse"></span>--}}
                                    {{--</div>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<!-- End Notification bar -->--}}
                    {{--</li>--}}

                    <li class="dropdown notification-list" style="padding-top: 15px;">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="false" aria-expanded="false">
                            <img src="/template/assets/images/logo-sm.jpeg" alt="user" class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ti-user m-r-5"></i> Profile
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ti-settings m-r-5"></i> Settings
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ti-lock m-r-5"></i> Lock screen
                            </a>

                            <!-- item-->
                            <a href="/logout" class="dropdown-item notify-item">
                                <i class="ti-power-off m-r-5"></i> Logout
                            </a>

                        </div>
                    </li>

                </ul>
            </div>
            <!-- end menu-extras -->

            <div class="clearfix"></div>

        </div> <!-- end container -->
    </div>
    <!-- end topbar-main -->

    <div class="navbar-custom">
        <div class="container-fluid">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li class="has-submenu">
                        <a href="{{ route('home') }}"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>
                    </li>
                    <li class="has-submenu">
                        <a href="{{ route('students') }}"><i class="mdi mdi-account-multiple"></i> <span> Students </span> </a>
                        {{--<ul class="submenu megamenu">--}}
                            {{--<li>--}}
                                {{--<ul>--}}
                                    {{--<li><a href="ui-buttons.html">Buttons</a></li>--}}
                                    {{--<li><a href="ui-cards.html">Cards</a></li>--}}
                                    {{--<li><a href="ui-draggable-cards.html">Draggable Cards</a></li>--}}
                                    {{--<li><a href="ui-typography.html">Typography </a></li>--}}
                                    {{--<li><a href="ui-checkbox-radio.html">Checkboxs-Radios</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    </li>

                    <li class="has-submenu">
                        <a href="{{ route('records') }}"><i class="mdi mdi-texture"></i><span> Records </span> </a>
                    </li>

                    <li class="has-submenu">
                        <a href="#"><i class="mdi mdi-account"></i> <span> Administrators </span> </a>
                    </li>

                    <li class="has-submenu">
                        <a href="#"><i class="mdi mdi-chart-donut-variant"></i><span> Others </span> </a>
                    </li>
                </ul>
                <!-- End navigation menu -->
            </div> <!-- end #navigation -->
        </div> <!-- end container -->
    </div> <!-- end navbar-custom -->
</header>