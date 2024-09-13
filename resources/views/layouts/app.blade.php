{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'B2-Forum') }}</title>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
         .navbar-custom {
            background-color: #ffffff; /* White background color */
            border-bottom: 1px solid #d3d3d3; /* Light grey border bottom */
        }

        .navbar-custom .navbar-brand {
            font-weight: bold;
            color: #007bff; /* Blue text color */
        }

        .navbar-custom .navbar-brand:hover {
            color: #0056b3; /* Darker blue hover text color */
        }

        .navbar-custom .nav-link {
            color: #007bff; /* Blue text color */
        }

        .navbar-custom .nav-link:hover {
            color: #0056b3; /* Darker blue hover text color */
        }

        .navbar-custom .dropdown-menu {
            border: none; /* Remove border from dropdown */
            background-color: #ffffff; /* Dropdown background color */
        }

        .navbar-custom .dropdown-menu a {
            color: #007bff; /* Dropdown link text color */
        }

        .navbar-custom .dropdown-menu a:hover {
            background-color: #f8f9fa; /* Light grey hover background color */
            color: #0056b3; /* Darker blue hover text color */
        }

        /* Additional custom styles */
        .navbar-nav .nav-item .nav-link.active {
            font-weight: bold;
            color: #0056b3; 
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%28%2C 123, 255, 0.5%29' stroke-width='2' linecap='round' linejoin='round' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }

        .card-header{
            color: #007bff;
        }
    </style>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    B2-Forum
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('forum*') ? 'active' : '' }}" href="{{ route('forum.index') }}">Forum</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('news') ? 'active' : '' }}" href="{{ url('/news') }}">News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('events') ? 'active' : '' }}" href="{{ url('/events') }}">Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ url('/about') }}">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ url('/contact') }}">Contact</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>