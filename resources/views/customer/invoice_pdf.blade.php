<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice - {{ $order->invoice_number ?? 'ORD-' . $order->id }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #333;
            font-size: 12px;
            line-height: 1.5;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #eee;
        }
        .header {
            margin-bottom: 20px;
            border-bottom: 2px solid #3A2E2B;
            padding-bottom: 10px;
        }
        .title {
            font-size: 20px;
            font-weight: bold;
            color: #3A2E2B;
            text-transform: uppercase;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th {
            background-color: #F8F6F0;
            color: #3A2E2B;
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
        }
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .text-right {
            text-align: right;
        }
        .total-row {
            font-weight: bold;
            background-color: #F8F6F0;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table style="width: 100%;">
            <tr>
                <td>
                    <div class="title">MAISON DE JENRINA</div>
                    <p style="margin: 0; color: #666;">Invoice Resmi Transaksi Belanja</p>
                </td>
                <td style="text-align: right;">
                    <p style="margin: 0;"><strong>No. Invoice:</strong> {{ $order->invoice_number ?? ('ORD-' . $order->id) }}</p>
                    <p style="margin: 0;"><strong>Tanggal:</strong> {{ $order->created_at ? $order->created_at->format('d M Y') : date('d M Y') }}</p>
                    <p style="margin: 0;"><strong>Status:</strong> <span style="color: green; font-weight: bold;">LUNAS</span></p>
                </td>
            </tr>
        </table>

        <hr style="border: none; border-top: 1px solid #eee; margin: 15px 0;">

        <table style="width: 100%;">
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <strong>Pembeli / Customer:</strong><br>
                    Nama: {{ $order->user->name ?? ($order->customer->name ?? 'Pelanggan') }}<br>
                    Email: {{ $order->user->email ?? ($order->customer->email ?? '-') }}<br>
                </td>
                <td style="width: 50%; vertical-align: top;">
                    <strong>Metode & Pengiriman:</strong><br>
                    Metode Bayar: {{ $order->payment_method ?? 'Bank Transfer' }}<br>
                    Alamat: {{ $order->shipping_address ?? 'Alamat Utama Customer' }}
                </td>
            </tr>
        </table>

        <table class="table">
            <thead>
                <tr>
                    <th>Item Produk</th>
                    <th style="text-align: center;">Jumlah</th>
                    <th class="text-right">Harga Satuan</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>{{ $order->product->name ?? 'Produk Pakaian' }}</strong><br>
                        <small style="color: #777;">Kategori: {{ $order->product->category ?? 'Fashion' }}</small>
                    </td>
                    <td style="text-align: center;">{{ $order->quantity ?? 1 }} pcs</td>
                    <td class="text-right">
                        Rp {{ number_format(($order->product->price ?? ($order->total_amount ?? $order->total_price ?? 0)), 0, ',', '.') }}
                    </td>
                    <td class="text-right">
                        Rp {{ number_format(($order->total_amount ?? $order->total_price ?? 0), 0, ',', '.') }}
                    </td>
                </tr>
                <tr class="total-row">
                    <td colspan="3" class="text-right">Total Pembayaran:</td>
                    <td class="text-right" style="color: #B86246;">
                        Rp {{ number_format(($order->total_amount ?? $order->total_price ?? 0), 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>

        <div style="margin-top: 30px; text-align: center; color: #888; font-size: 10px;">
            Terima kasih telah berbelanja busana impian Anda di <strong>Maison De Jenrina</strong>!
        </div>
    </div>
</body>
</html>