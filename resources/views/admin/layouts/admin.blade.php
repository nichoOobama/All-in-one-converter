<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-slate-900 to-slate-800 text-gray-300 shadow-xl">
            <div class="p-5 border-b border-slate-700/50">
                <h1 class="text-xl font-bold text-white flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-blue-500 shadow-[0_0_8px_rgba(59,130,246,0.7)]"></span>
                    Admin Panel
                </h1>
            </div>
            <nav class="mt-4 space-y-1 px-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white font-medium shadow-md shadow-blue-900/40' : 'hover:bg-slate-700/60 hover:text-white' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm transition-all {{ request()->routeIs('admin.users.*') ? 'bg-blue-600 text-white font-medium shadow-md shadow-blue-900/40' : 'hover:bg-slate-700/60 hover:text-white' }}">
                    Users
                </a>
                <a href="{{ route('admin.conversions.index') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm transition-all {{ request()->routeIs('admin.conversions.*') ? 'bg-blue-600 text-white font-medium shadow-md shadow-blue-900/40' : 'hover:bg-slate-700/60 hover:text-white' }}">
                    Conversions
                </a>
                <a href="{{ route('admin.licenses.index') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm transition-all {{ request()->routeIs('admin.licenses.*') ? 'bg-blue-600 text-white font-medium shadow-md shadow-blue-900/40' : 'hover:bg-slate-700/60 hover:text-white' }}">
                    Licenses
                </a>
                <a href="{{ route('admin.versions.index') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm transition-all {{ request()->routeIs('admin.versions.*') ? 'bg-blue-600 text-white font-medium shadow-md shadow-blue-900/40' : 'hover:bg-slate-700/60 hover:text-white' }}">
                    Versions
                </a>
                <a href="{{ route('admin.settings') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm transition-all {{ request()->routeIs('admin.settings') ? 'bg-blue-600 text-white font-medium shadow-md shadow-blue-900/40' : 'hover:bg-slate-700/60 hover:text-white' }}">
                    Settings
                </a>
            </nav>
            <div class="mt-8 border-t border-slate-700/50 p-4 space-y-1">
                <a href="/" class="block px-4 py-2.5 rounded-lg text-sm hover:bg-slate-700/60 hover:text-white transition-all">Back to Site</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2.5 rounded-lg text-sm hover:bg-slate-700/60 hover:text-white transition-all">Logout</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            @if (session('success'))
                <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg mb-4 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4 shadow-sm">
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