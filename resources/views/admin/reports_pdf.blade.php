<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan — Maison De Jenrina</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #3A2E2B;
            font-size: 11px;
            padding: 10px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #3A2E2B;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
            color: #3A2E2B;
            text-transform: uppercase;
            font-size: 18px;
            letter-spacing: 1px;
        }
        .header p {
            margin: 3px 0 0;
            color: #777;
            font-size: 10px;
        }
        .summary-box {
            background-color: #F8F6F0;
            border: 1px solid #EADFC7;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .summary-title {
            font-size: 10px;
            text-transform: uppercase;
            color: #777;
            font-weight: bold;
            margin-bottom: 4px;
        }
        .summary-value {
            font-size: 18px;
            font-weight: bold;
            color: #B86246;
        }
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table.data-table th, table.data-table td {
            border: 1px solid #EADFC7;
            padding: 8px 10px;
            text-align: left;
        }
        table.data-table th {
            background-color: #3A2E2B;
            color: #ffffff;
            font-size: 9px;
            text-transform: uppercase;
        }
        table.data-table tr:nth-child(even) {
            background-color: #F8F6F0;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 9px;
            color: #888;
        }
    </style>
</head>
<body>

    <!-- Header Dokumen -->
    <div class="header">
        <h2>MAISON DE JENRINA</h2>
        <p>Laporan Penjualan & Transaksi Toko</p>
        <p>Dicetak pada: {{ date('d F Y, H:i') }} WIB</p>
    </div>

    <!-- Kotak Ringkasan Total Pendapatan -->
    <div class="summary-box">
        <div class="summary-title">Total Pendapatan Penjualan</div>
        <div class="summary-value">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</div>
    </div>

    <!-- Tabel Data Transaksi -->
    <table class="data-table">
        <thead>
            <tr>
                <th class="text-center" style="width: 5%;">No</th>
                <th style="width: 18%;">ID Pesanan</th>
                <th style="width: 15%;">Tanggal</th>
                <th style="width: 20%;">Pelanggan</th>
                <th style="width: 22%;">Produk</th>
                <th class="text-center" style="width: 8%;">Qty</th>
                <th class="text-right" style="width: 20%;">Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $index => $order)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>#ORD-{{ $order->id }}</td>
                    <td>{{ $order->created_at ? $order->created_at->format('d/m/Y') : '-' }}</td>
                    <td>{{ $order->user->name ?? 'Guest' }}</td>
                    <td>{{ $order->product->name ?? '-' }}</td>
                    <td class="text-center">{{ $order->quantity ?? 1 }}</td>
                    <td class="text-right">Rp {{ number_format($order->total_price ?? 0, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center" style="padding: 20px; color: #999;">Belum ada data transaksi yang tercatat.</td>
                </tr>
            @endforelse
        </tbody>
        @if(count($orders) > 0)
        <tfoot>
            <tr style="background-color: #EADFC7; font-weight: bold;">
                <td colspan="6" class="text-right">TOTAL PENDAPATAN:</td>
                <td class="text-right">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
        @endif
    </table>

    <!-- Footer Dokumen -->
    <div class="footer">
        <p>Dokumen ini dihasilkan secara otomatis oleh Sistem Portal Maison De Jenrina.</p>
    </div>

</body>
</html>