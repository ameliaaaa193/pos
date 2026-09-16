<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body { background: #f8f5f6; min-height: 100vh; margin: 0; }
        .app-wrapper { display: flex; min-height: 100vh; position: relative; }
        .app-main { flex: 1; display: flex; flex-direction: column; min-width: 0; }
        .app-topbar {
            display: flex; justify-content: space-between; align-items: center;
            gap: 1rem; padding: 1rem 2rem; background: #fff; border-bottom: 1px solid #f1e3e8;
        }
        .app-topbar .btn-danger { background: #db2763; border: none; border-radius: 0.5rem; }
        .app-topbar .btn-danger:hover { background: #b91c4f; }
        .app-content { padding: 2rem; }

        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #db2763;
            cursor: pointer;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 1030;
        }
        .sidebar-overlay.active { display: block; }

        @media (max-width: 992px) {
            .app-content { padding: 1.25rem; }
            .app-topbar { padding: 1rem; }
        }

        @media (max-width: 768px) {
            .sidebar-toggle { display: inline-block; }

            .sidebar {
                position: fixed;
                top: 0; left: 0; bottom: 0;
                width: 260px;
                max-width: 80%;
                transform: translateX(-100%);
                transition: transform 0.25s ease-in-out;
                z-index: 1040;
                overflow-y: auto;
            }
            .sidebar.open { transform: translateX(0); }

            .app-content { padding: 1rem; }
            .app-topbar { padding: 0.75rem 1rem; }
        }

        @media (max-width: 480px) {
            .app-content { padding: 0.75rem; }
        }
    </style>
</head>
<body>

<div class="app-wrapper">

    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    @include('layouts.navbar')

    <div class="app-main">
        <div class="app-topbar">
            <button class="sidebar-toggle" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success')}}
                    </div>
                @endif

                @yield('content')

            </div>
        </div>
    </div>

</div>

<script>
    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('open');
        document.getElementById('sidebarOverlay').classList.toggle('active');
    }
</script>

</body>
</html>