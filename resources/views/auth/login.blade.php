<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Maison De Jenrina</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- FontAwesome Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8F6F0; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#F8F6F0] text-stone-800 antialiased min-h-screen flex flex-col justify-between">

    <!-- Top Navigation Bar (Logo di Kiri, Tombol Kembali di Kanan) -->
    <header class="bg-white border-b border-[#EADFC7] px-8 py-4 flex items-center justify-between shadow-xs">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-9 h-9 object-cover rounded-full border border-[#A38875] p-0.5 bg-white shadow-sm">
            <h1 class="font-serif font-bold text-base text-[#3A2E2B] tracking-wide">Maison De Jenrina</h1>
        </div>
        <a href="{{ route('landing') }}" class="px-4 py-2 bg-[#F8F6F0] hover:bg-[#EFEADB] text-[#3A2E2B] border border-[#EADFC7] rounded-xl text-xs font-bold transition flex items-center gap-2 shadow-xs">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Beranda</span>
        </a>
    </header>

    <!-- Konten Utama Form Login -->
    <main class="flex-1 flex items-center justify-center p-6">
        <div class="w-full max-w-md bg-white rounded-3xl border border-[#EADFC7] p-8 shadow-xl space-y-6">
            
            <!-- Header Kartu dengan Logo & Judul -->
            <div class="text-center space-y-2">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-[#F8F6F0] border-2 border-[#A38875] shadow-sm mb-1 overflow-hidden p-1">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Maison De Jenrina" class="w-full h-full object-cover rounded-full">
                </div>
                <h2 class="text-2xl font-serif font-bold text-[#3A2E2B]">Selamat Datang</h2>
                <p class="text-xs text-stone-500">Masuk ke akun Anda untuk mengelola pesanan dan produk.</p>
            </div>

            @if($errors->any())
                <div class="p-3 bg-rose-100 border border-rose-300 text-rose-800 text-xs font-semibold rounded-xl flex items-center gap-2">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>Email atau password yang Anda masukkan salah.</span>
                </div>
            @endif

            <!-- Form Login Password -->
            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="text-xs font-bold text-stone-700 block mb-1">Alamat Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-stone-400 text-xs">
                            <i class="fa-regular fa-envelope"></i>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com"
                               class="w-full text-xs pl-10 pr-4 py-3.5 rounded-xl border border-[#EADFC7] bg-[#F8F6F0]/40 focus:bg-white focus:outline-none focus:border-[#A38875]">
                    </div>
                </div>

                <div>
                    <label class="text-xs font-bold text-stone-700 block mb-1">Kata Sandi (Password)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-stone-400 text-xs">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" name="password" required placeholder="••••••••"
                               class="w-full text-xs pl-10 pr-4 py-3.5 rounded-xl border border-[#EADFC7] bg-[#F8F6F0]/40 focus:bg-white focus:outline-none focus:border-[#A38875]">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3.5 bg-[#3A2E2B] hover:bg-[#52423D] text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-md transition cursor-pointer flex items-center justify-center gap-2">
                        <i class="fa-solid fa-right-to-bracket"></i> Masuk Sekarang
                    </button>
                </div>
            </form>

            <div class="relative flex py-2 items-center">
                <div class="flex-grow border-t border-stone-200"></div>
                <span class="flex-shrink mx-4 text-[10px] text-stone-400 uppercase tracking-widest font-bold">Atau Metode OTP</span>
                <div class="flex-grow border-t border-stone-200"></div>
            </div>

            <!-- Form Metode OTP -->
            <form action="#" method="POST" class="space-y-3">
                @csrf
                <div>
                    <input type="email" name="otp_email" placeholder="Masukkan email terdaftar untuk OTP"
                           class="w-full text-xs p-3.5 rounded-xl border border-[#EADFC7] bg-[#F8F6F0]/40 focus:bg-white focus:outline-none focus:border-[#A38875]">
                </div>
                <button type="submit" class="w-full py-3 bg-[#C4B2A5] hover:bg-[#A38875] text-white font-bold text-xs uppercase tracking-wider rounded-xl transition cursor-pointer">
                    Kirim Kode OTP ke Email
                </button>
            </form>

        </div>
    </main>

    <!-- Footer Sederhana -->
    <footer class="py-4 text-center text-stone-400 text-[11px] border-t border-[#EADFC7] bg-white">
        &copy; 2026 Maison De Jenrina Fashion Store. All rights reserved.
    </footer>

</body>
</html>