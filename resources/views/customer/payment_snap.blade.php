<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Pesanan — Maison De Jenrina</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Script Midtrans Snap (Sandbox) -->
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
</head>
<body class="bg-[#F8F6F0] flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-3xl border border-[#EADFC7] shadow-xl text-center max-w-md w-full space-y-4">
        <div class="w-16 h-16 bg-[#3A2E2B] text-white rounded-full flex items-center justify-center mx-auto text-2xl font-bold">
            🛍️
        </div>
        <h2 class="text-xl font-bold text-[#3A2E2B]">Selesaikan Pembayaran Anda</h2>
        <p class="text-xs text-stone-500">Order ID: <span class="font-bold text-stone-700">{{ $orderId }}</span></p>
        <p class="text-sm font-extrabold text-[#B86246]">Total: Rp {{ number_format($totalAmount, 0, ',', '.') }}</p>

        <button id="pay-button" 
                class="w-full py-3.5 bg-[#3A2E2B] hover:bg-[#52423D] text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-md transition cursor-pointer">
            Bayar Sekarang via Midtrans
        </button>

        <a href="{{ route('customer.dashboard') }}" class="block text-xs font-bold text-stone-400 hover:text-stone-700 pt-2">
            Kembali ke Beranda
        </a>
    </div>

    <script type="text/javascript">
        // Otomatis buka pop-up Snap saat halaman dimuat
        window.onload = function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    alert("Pembayaran berhasil!");
                    window.location.href = "{{ route('customer.orders') }}";
                },
                onPending: function(result){
                    alert("Menunggu pembayaran Anda.");
                    window.location.href = "{{ route('customer.orders') }}";
                },
                onError: function(result){
                    alert("Pembayaran gagal!");
                    window.location.href = "{{ route('customer.orders') }}";
                },
                onClose: function(){
                    alert('Anda menutup popup pembayaran tanpa menyelesaikan transaksi.');
                    window.location.href = "{{ route('customer.orders') }}";
                }
            });
        };

        document.getElementById('pay-button').onclick = function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    window.location.href = "{{ route('customer.orders') }}";
                },
                onPending: function(result){
                    window.location.href = "{{ route('customer.orders') }}";
                },
                onError: function(result){
                    window.location.href = "{{ route('customer.orders') }}";
                },
                onClose: function(){}
            });
        };
    </script>
</body>
</html>