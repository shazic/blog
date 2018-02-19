<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    @yield('customstyles')
</head>
<body>
    <style>
        a.sidebar-menu, a.sidebar-submenu {
            text-decoration: none;
        }
        a.sidebar-submenu li   {
            background-color: #efe;
        }
        a.sidebar-submenu li:hover   {
            background-color: #ded;
        }
        a.sidebar-menu li {
            /*border: 1px #abc solid;*/
        }
        a.sidebar-menu li:hover {
            background-color: #ddf;
        }
    </style>

    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @auth
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <ul class="list-group">
                            <a href="{{ route('home') }}" class="sidebar-menu">
                                <li class="list-group-item active" >
                                Dashboard
                                </li>
                            </a>
                            <a href="{{ route('profile') }}" class="sidebar-menu">
                                <li class="list-group-item" >
                                My Profile
                                </li>
                            </a>
                            @if( Auth::user()->admin )
                                <a href="{{ route('users') }}" class="sidebar-menu">
                                    <li class="list-group-item">
                                    Users
                                    </li>
                                </a>
                            @endif
                            <a href="{{ route('posts') }}" class="sidebar-menu">
                                <li class="list-group-item">
                                Posts
                                </li>
                            </a>
                            <a href="{{ route('trashed') }}" class="sidebar-menu">
                                <li class="list-group-item">
                                    Trash
                                </li>
                            </a>
                            <a href="{{ route('categories') }}" class="sidebar-menu">
                                <li class="list-group-item">
                                    Categories
                                </li>
                            </a>
                            <a href="{{ route('tags') }}" class="sidebar-menu">
                                    <li class="list-group-item">
                                        Tags
                                    </li>
                            </a>
                            @if( Auth::user()->admin )
                                <a href="{{ route('user.create') }}" class="sidebar-submenu">
                                    <li class="list-group-item">
                                        Create a new user
                                    </li>
                                </a>
                            @endif
                            <a href="{{ route('post.create') }}" class="sidebar-submenu">
                                <li class="list-group-item">
                                    Create a new post
                                </li>
                            </a>
                            <a href="{{ route('category.create') }}" class="sidebar-submenu">
                                <li class="list-group-item">
                                    Create a new category
                                </li>
                            </a>
                            <a href="{{ route('tag.create') }}" class="sidebar-submenu">
                                <li class="list-group-item">
                                    Create a new Tag
                                </li>
                            </a>
                            @if( Auth::user()->admin )
                                <a href="{{ route('settings') }}" class="sidebar-menu">
                                    <li class="list-group-item" >
                                    Settings
                                    </li>
                                </a>
                            @endif
                        </ul>
                    </div>
                    <div class="col-md-9">
                        @include('includes.alerts')
                        @yield('content')
                    </div>
                </div>
            </div>
        @else
            @yield('content')
        @endauth
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    @yield('customjs')
</body>
</html>
