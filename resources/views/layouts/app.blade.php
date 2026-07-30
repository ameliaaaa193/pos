<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body { background: #f8f5f6; min-height: 100vh; margin: 0; }
        .app-wrapper { display: flex; min-height: 100vh; }
        .app-main { flex: 1; display: flex; flex-direction: column; min-width: 0; }
        .app-topbar {
            display: flex; justify-content: flex-end; align-items: center;
            gap: 1rem; padding: 1rem 2rem; background: #fff; border-bottom: 1px solid #f1e3e8;
        }
        .app-topbar .btn-danger { background: #db2763; border: none; border-radius: 0.5rem; }
        .app-topbar .btn-danger:hover { background: #b91c4f; }
        .app-content { padding: 2rem; }
        @media (max-width: 768px) { .app-wrapper { flex-direction: column; } }
    </style>
</head>
<body>

<div class="app-wrapper">

    @include('layouts.navbar')

    <div class="app-main">
        <div class="app-topbar">
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

</body>
</html>