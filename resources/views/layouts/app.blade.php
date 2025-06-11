<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HydroFish</title>
    <link rel="icon" href="{{ asset('img/hydrofish.png') }}" type="image/png">



    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Firebase (optional if needed) -->
    <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-database.js"></script>
</head>
<body>
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon1"><ion-icon name="fish-outline"></ion-icon></span>
                        <span class="title1">HydroFish</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/dashboard') }}">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/history') }}">
                        <span class="icon"><ion-icon name="archive-outline"></ion-icon></span>
                        <span class="title">History</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/setting') }}">
                        <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                        <span class="title">Settings</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ url('/logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                        <span class="title">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li> --}}
            </ul>
        </div>

        {{-- Tempat konten halaman --}}
        @yield('content')
    </div>

    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <!-- Main JS -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
