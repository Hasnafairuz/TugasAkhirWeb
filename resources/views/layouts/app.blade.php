<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maison De Jenrina — K-Fashion & Loungewear</title>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cream: '#FAF8F5',
                        softbeige: '#EFECE6',
                        dustypink: '#D9A79A',
                        darkbrown: '#3E2723',
                        sagegreen: '#A3B18A',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-cream text-darkbrown font-sans min-h-screen flex flex-col justify-between">

    <!-- Header / Navbar -->
    <header class="bg-softbeige border-b border-softbeige/80 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-serif font-bold tracking-wide text-darkbrown">
                Maison De Jenrina
            </a>

            <!-- Form Pencarian -->
            <form action="/" method="GET" class="hidden md:flex items-center w-1/3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari baju Korea, knitwear, loungewear..." class="w-full px-4 py-2 rounded-full border border-softbeige bg-cream text-sm focus:outline-none focus:ring-1 focus:ring-dustypink">
            </form>

            <div class="flex items-center space-x-4">
                @auth
                    <span class="text-xs bg-dustypink/20 text-darkbrown px-3 py-1 rounded-full font-medium">
                        {{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})
                    </span>

                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-xs font-semibold hover:text-dustypink">Dashboard</a>
                    @elseif(Auth::user()->role === 'seller')
                        <a href="{{ route('seller.dashboard') }}" class="text-xs font-semibold hover:text-dustypink">Panel Toko</a>
                    @elseif(Auth::user()->role === 'customer')
                        <a href="{{ route('customer.orders') }}" class="text-xs font-semibold hover:text-dustypink">Pesanan Saya</a>
                    @endif

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-xs text-red-600 font-semibold hover:underline">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-darkbrown text-cream text-xs font-semibold px-5 py-2 rounded-full hover:opacity-90 transition">
                        Login / Masuk
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Content Utama -->
    <main class="max-w-7xl mx-auto px-6 py-8 flex-grow w-full">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-softbeige border-t border-softbeige text-center py-6 text-xs text-darkbrown/60">
        <p>&copy; {{ date('Y') }} Maison De Jenrina. All rights reserved. Elegant K-Style & Loungewear.</p>
    </footer>

</body>
</html>