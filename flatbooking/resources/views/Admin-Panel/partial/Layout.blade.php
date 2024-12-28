<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    {{-- -- Favicon icon -- --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">

    <link href="{{ asset('asset/css/bootstrap.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('vendor/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/custom-style.css') }}" rel="stylesheet">

    {{---- Datatable ----}}
        {{-- CSS --}}
        <link href="{{ asset('asset/DataTable/css/dataTables.dataTables.css') }}" rel="stylesheet">
        <link href="{{ asset('asset/DataTable/css/buttons.dataTables.css') }}" rel="stylesheet">

        {{-- Javascript --}}
        <script src="{{ asset('asset/js/jquery.min.js') }}"></script>
        <script src="{{ asset('asset/DataTable/js/datatable.js') }}"></script>
        <script src="{{ asset('asset/DataTable/js/buttons.js') }}"></script>
        <script src="{{ asset('asset/DataTable/js/buttons.dataTables.js') }}"></script>
        <script src="{{ asset('asset/DataTable/js/jszip.min.js') }}"></script>
        <script src="{{ asset('asset/DataTable/js/pdfmake.min.js') }}"></script>
        <script src="{{ asset('asset/DataTable/js/vfs_fonts.js') }}"></script>
        <script src="{{ asset('asset/DataTable/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('asset/DataTable/js/buttons.print.min.js') }}"></script>
    {{---- Datatable ----}}



    <title>Parents Engineering Ltd </title>
</head>

<body>

    {{-- --*******************
        Preloader start
    ********************-- --}}
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    {{-- --*******************
        Preloader end
    ********************-- --}}


    {{-- --**********************************
        Main wrapper start
    ***********************************-- --}}
    <div id="main-wrapper">

        {{-- --**********************************
            Nav header start
        ***********************************-- --}}
        <div class="nav-header bg-white">
            <a href="" class="brand-logo">
                {{-- <img class="logo-abbr" style="max-width: 52px;" src="{{ asset('images/logo.png') }}" alt="">
                <img class="logo-compact" src="{{ asset('images/logo-text.png') }}" alt=""> --}}
                <img class="brand-title  " style="max-width:100px" src=""  alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        {{-- --**********************************
            Nav header end
        ***********************************-- --}}

        {{-- --**********************************
            Header start
        ***********************************-- --}}
        <div class="header">

            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Search"
                                            aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="fa-solid fa-bell"></i>
                                    <div class="pulse-css"></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="list-unstyled">
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="fa-solid fa-user"></i> </span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Martin</strong> has added a <strong>customer</strong>
                                                        Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>

                                    </ul>
                                    <a class="all-notification" href="#">See all notifications <i
                                            class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="fa-solid fa-user"></i>
                                    @if (auth()->user())
                                        <span>{{ auth()->user()->name }}</span>
                                    @endif
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="./app-profile.html" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="./email-inbox.html" class="dropdown-item">
                                        <i class="icon-envelope-open"></i>
                                        <span class="ml-2">Inbox </span>
                                    </a>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="dropdown-item ms-2" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); this.closest('form').submit();">Log
                                            out</a>
                                    </form>
                                    {{-- <form method="POST" action="">
                                        @csrf
                                        <a class="dropdown-item" href="" onclick="event.preventDefault(); this.closest('form').submit();">Log
                                            out</a>
                                    </form> --}}
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        {{-- --**********************************
            Header end ti-comment-alt
        ***********************************-- --}}

        {{-- --**********************************
            Sidebar start
        ***********************************-- --}}
        <div class="quixnav" >

            <div class="quixnav-scroll" style="overflow-y: scroll; " >
                <ul class="metismenu" id="menu">

                    <li class="nav-label first">Main Menu</li>

                    <li>
                        <a class="has-arrow" href="{{ route('dashboard') }}" aria-expanded="false">
                            <i class="fa-solid fa-gauge"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    {{-- @can('list project') --}}
                        <li>
                            <a class="has-arrow" href="{{ route('list.project') }}" aria-expanded="false">
                                <i class="fa-solid fa-diagram-project"></i>
                                <span class="nav-text">Project</span>
                            </a>
                        </li>
                    {{-- @endcan --}}



                    <li>
                        <a class="has-arrow" href="{{ route('vendor.list') }}" aria-expanded="false">
                            <i class="fa-solid fa-store"></i>
                            <span class="nav-text">Vandor</span>
                        </a>
                    </li>

                    {{-- ====== Employee ======= --}}
                    {{-- @can('view employee') --}}
                    <li id="employee-parent">
                        <a class="has-arrow" href="{{ route('employee.list') }}" aria-expanded="false">
                            <i class="fa-solid fa-user-tie"></i>
                            <span class="nav-text">Employee</span>
                        </a>
                    </li>
                    {{-- @endcan --}}
                    {{--======= Employee End =======--}}

                    {{--========= Customer ===========--}}
                    {{-- @can('list customer') --}}
                    <li id="client-parent">
                        <a class="has-arrow" href="{{ route('client.list') }}" aria-expanded="false">
                            <i class="fa-solid fa-users"></i>
                            <span class="nav-text">Client</span>
                        </a>
                    </li>
                    {{-- @endcan --}}
                    {{--========= Customer End ===========--}}

                    {{-- Expanse --}}
                    <li id="expanse-parent">
                        <a class="has-arrow" href="javascript:void(0);" data-bs-toggle="collapse"
                            data-bs-target="#expanse" aria-expanded="false" aria-controls="expanse">
                            <i class="fa-solid fa-store"></i>
                            <span class="nav-text">Expanse </span>
                        </a>
                        <div id="expanse" class="accordion-collapse collapse" style="background-color: #1c0f54"
                            data-bs-parent="#expanse-parent">
                            <ul class=" metismenu">
                                <li>
                                    <a class="has-arrow" href="">
                                        <i class="fa-solid fa-store"></i>
                                        <span class="nav-text">Project Expanse</span>
                                    </a>
                                </li>

                                <li>
                                    <a class="has-arrow" href="">
                                        <i class="fa-solid fa-store"></i>
                                        <span class="nav-text">Office Ex Category </span>
                                    </a>
                                </li>

                                <li>
                                    <a class="has-arrow" href="">
                                        <i class="fa-solid fa-store"></i>
                                        <span class="nav-text">Office Expanse </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- Project End --}}


                    <li>
                        <a class="has-arrow" href="{{ route('users.index') }}">
                            <i class="fa-solid fa-user"></i>
                            <span class="nav-text">Users</span>
                        </a>
                    </li>
                    <li>
                        <a class="has-arrow" href="{{ route('roles.index') }}">
                            <i class="fa-solid fa-pen-ruler"></i>
                            <span class="nav-text">Roles</span>
                        </a>
                    </li>

                    <li class="nav-label first">Company Info</li>
                    <li>
                        <a class="has-arrow" href="{{ route('company.info.list') }}">
                            <i class="fa-solid fa-pen-ruler"></i>
                            <span class="nav-text">Company Info</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        {{-- --**********************************
            Sidebar end
        ***********************************-- --}}

        {{-- --**********************************
            Content body start
        ***********************************-- --}}
        {{-- <div class="content-body"> --}}
        <div class="content-body">
            <div class="container-fluid">

                @yield('content')

            </div>
        </div>
        {{-- --**********************************
            Content body end
        ***********************************-- --}}


        {{-- --**********************************
            Footer start
        ***********************************-- --}}
        <div class="footer align-self-end">
            <div class="copyright">
                <p>Copyright © 2024. &amp; Developed by <a href="#" target="_blank">Coder de Dhaka</a> </p>
            </div>
        </div>
        {{-- --**********************************
            Footer end
        ***********************************-- --}}
    </div>

    {{-- -- Required vendors -- --}}
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('asset/js/quixnav-init.js') }}"></script>
    <script src="{{ asset('asset/js/custom.min.js') }}"></script>
    <script src="{{ asset('asset/js/print.js') }}"></script>

    {{-- <script src="{{ asset('vendor/moment/moment.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendor/pg-calendar/js/pignose.calendar.min.js') }}"></script> --}}

    <script src="{{ asset('asset/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
