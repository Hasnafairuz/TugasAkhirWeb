<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function exportSalesPDF()
    {
        // Ambil data transaksi beserta relasi user & product
        $orders = Order::with(['user', 'product'])->latest()->get();
        
        // Hitung total pendapatan
        $totalRevenue = $orders->sum('total_price');

        // Load view ke engine DomPDF
        $pdf = Pdf::loadView('admin.reports_pdf', compact('orders', 'totalRevenue'));

        // Unduh langsung berkas PDF
        return $pdf->download('Laporan-Penjualan-MaisonDeJenrina-' . date('Y-m-d') . '.pdf');
    }

    public function exportSalesExcel()
    {
        $fileName = 'Laporan-Penjualan-' . date('Y-m-d') . '.csv';
        $orders = Order::with(['user', 'product'])->latest()->get();

        $headers = array(
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('ID Pesanan', 'Tanggal', 'Nama Pelanggan', 'Produk', 'Jumlah', 'Total Harga', 'Status');

        $callback = function() use($orders, $columns) {
            $file = fopen('php://output', 'w');
            
            // 1. Tambahkan UTF-8 BOM agar Excel membaca karakter & format kolom dengan benar
            fputs($file, "\xEF\xBB\xBF");

            // 2. Gunakan pemisah titik koma (;) sebagai delimiter untuk Excel regional Indonesia
            fputcsv($file, $columns, ';');

            foreach ($orders as $order) {
                fputcsv($file, array(
                    '#ORD-' . $order->id,
                    $order->created_at ? $order->created_at->format('d/m/Y') : '-',
                    $order->user->name ?? 'Guest',
                    $order->product->name ?? '-',
                    $order->quantity ?? 1,
                    'Rp ' . number_format($order->total_price ?? 0, 0, ',', '.'),
                    ucfirst($order->status ?? 'paid')
                ), ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}