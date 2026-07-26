<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white">
            <div class="p-4">
                <h1 class="text-xl font-bold">Admin Panel</h1>
            </div>
            <nav class="mt-4">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.users.*') ? 'bg-gray-700' : '' }}">
                    Users
                </a>
                <a href="{{ route('admin.conversions.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.conversions.*') ? 'bg-gray-700' : '' }}">
                    Conversions
                </a>
                <a href="{{ route('admin.licenses.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.licenses.*') ? 'bg-gray-700' : '' }}">
                    Licenses
                </a>
                <a href="{{ route('admin.versions.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.versions.*') ? 'bg-gray-700' : '' }}">
                    Versions
                </a>
                <a href="{{ route('admin.settings') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.settings') ? 'bg-gray-700' : '' }}">
                    Settings
                </a>
            </nav>
            <div class="mt-8 border-t border-gray-600 p-4">
                <a href="/" class="block px-4 py-2 hover:bg-gray-700">Back to Site</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-700">Logout</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
