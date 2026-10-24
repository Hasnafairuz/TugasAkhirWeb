<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Resi Invoice #{{ $order->invoice_number ?? 'INV-' . $order->id }}</title>
    <style>
        @page {
            margin: 0;
            size: 80mm auto; /* Ukuran Resi Thermal */
        }
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 11px;
            color: #222;
            background-color: #fff;
            padding: 15px;
            margin: 0 auto;
            max-width: 300px;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        .border-dashed { border-bottom: 1px dashed #444; margin: 10px 0; }
        .border-double { border-bottom: 3px double #444; margin: 10px 0; }
        .table { width: 100%; border-collapse: collapse; }
        .table td { padding: 3px 0; vertical-align: top; }
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border: 1px solid #3A2E2B;
            font-size: 10px;
            font-weight: bold;
            margin-top: 4px;
        }
    </style>
</head>
<body>

    <!-- BRAND HEADER -->
    <div class="text-center">
        <h2 style="margin: 0; font-size: 15px; font-family: sans-serif;">MAISON DE JENRINA</h2>
        <p style="margin: 2px 0 0 0; font-size: 9px;">KOREAN & FRENCH FASHION STORE</p>
        <p style="margin: 2px 0 0 0; font-size: 9px;">www.maisondejenrina.com</p>
    </div>

    <div class="border-double"></div>

    <!-- INFORMASI RESI & PESANAN -->
    <div class="text-center">
        <span class="font-bold" style="font-size: 12px;">RESI PENGIRIMAN & NOTA</span>
        <div class="badge">{{ strtoupper($order->status ?? 'PAID') }}</div>
    </div>

    <div class="border-dashed"></div>

    <table class="table">
        <tr>
            <td>No. Invoice</td>
            <td class="text-right font-bold">#{{ $order->invoice_number ?? 'INV-' . $order->id }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td class="text-right">{{ \Carbon\Carbon::parse($order->created_at ?? now())->format('d M Y H:i') }}</td>
        </tr>
        <tr>
            <td>Metode Bayar</td>
            <td class="text-right font-bold">{{ strtoupper($order->payment_method ?? 'OVO / Transfer') }}</td>
        </tr>
    </table>

    <div class="border-dashed"></div>

    <!-- ALAMAT PENGIRIMAN -->
    <div>
        <span class="font-bold">PENGIRIM:</span><br>
        Maison De Jenrina Official<br>
        <span style="font-size: 9px;">(0812-3456-7890)</span><br><br>

        <span class="font-bold">PENERIMA:</span><br>
        {{ $order->user->name ?? 'Pelanggan' }}<br>
        <span style="font-size: 10px;">{{ $order->address ?? 'Alamat Utama Pembeli' }}</span>
    </div>

    <div class="border-dashed"></div>

    <!-- DETAIL ITEM BELANJA (DAFTAR SEMUA PRODUK) -->
    <span class="font-bold">RINCIAN PRODUK:</span>
    <table class="table" style="margin-top: 5px;">
        @if($order->orderItems && $order->orderItems->count() > 0)
            @foreach($order->orderItems as $item)
                <tr>
                    <td class="font-bold" colspan="2">{{ $item->product->name ?? 'Produk Pesanan' }}</td>
                </tr>
                <tr>
                    <td>{{ $item->quantity }}x @ Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="text-right font-bold">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                </tr>
                <tr><td colspan="2"><div style="border-bottom: 1px dotted #ccc; margin: 3px 0;"></div></td></tr>
            @endforeach
        @else
            <!-- Cadangan Jika Transaksi Lama (Tunggal) -->
            <tr>
                <td class="font-bold" colspan="2">{{ $order->product->name ?? 'Lala Top Salur Korea Style' }}</td>
            </tr>
            <tr>
                <td>{{ $order->quantity ?? 1 }}x @ Rp {{ number_format($order->product->discount_price ?? $order->product->price ?? $order->total_price, 0, ',', '.') }}</td>
                <td class="text-right font-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
            </tr>
        @endif
    </table>

    <div class="border-dashed"></div>

    <!-- TOTAL PEMBAYARAN -->
    <table class="table">
        <tr>
            <td>Subtotal Produk</td>
            <td class="text-right">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Ongkos Kirim</td>
            <td class="text-right">Rp 0 (GRATIS)</td>
        </tr>
        <tr class="font-bold" style="font-size: 12px;">
            <td style="padding-top: 6px;">TOTAL BAYAR</td>
            <td class="text-right" style="padding-top: 6px;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="border-double"></div>

    <!-- FOOTER / PESAN -->
    <div class="text-center" style="font-size: 9px; margin-top: 10px;">
        <p style="margin: 0;">Terima kasih telah berbelanja di<br><strong>Maison De Jenrina</strong>!</p>
        <p style="margin-top: 5px; font-style: italic;">Simpan resi ini sebagai bukti transaksi sah.</p>
    </div>

    <!-- AUTO PRINT SCRIPT UNTUK BROWSER -->
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>