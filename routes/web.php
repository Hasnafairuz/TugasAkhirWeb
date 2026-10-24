<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReportController;
use App\Models\Product;
use App\Models\Order;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


// 1. Landing Page & Search
Route::get('/', function (Request $request) {
    $query = Product::query();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('category', 'like', '%' . $search . '%');
        });
    }

    $products = $query->latest()->get();
    
    return view('landing', compact('products'));
})->name('landing');

Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');
// 2. Authentication Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email'    => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'seller') {
            return redirect()->route('seller.dashboard');
        } else {
            return redirect()->route('customer.dashboard');
        }
    }

    return back()->withErrors([
        'email' => 'Email atau password yang Anda masukkan salah.',
    ])->onlyInput('email');
});

Route::post('/login/password', [AuthController::class, 'loginWithPassword'])->name('login.password');
Route::post('/login/otp/send', [AuthController::class, 'sendOTP'])->name('login.otp.send');
Route::post('/login/otp/verify', [AuthController::class, 'verifyOTP'])->name('login.otp.verify');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 3. Protected Routes (Harus Login)
Route::middleware(['auth'])->group(function () {

    // --- RUTE CHAT PELANGGAN KE ADMIN ---
    Route::post('/product/{id}/chat', [ChatController::class, 'store'])->name('product.chat.store');

    // Admin Dashboard & Sidebar Navigation
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            $totalUsers     = User::count();
            $totalCustomers = User::where('role', 'customer')->count();
            $totalStores    = Store::count();
            $totalProducts  = Product::count();
            $totalOrders    = Order::count();
            
            $totalRevenue   = Order::sum('total_price') ?? 0;
            $recentOrders   = Order::with('product', 'user')->latest()->take(5)->get();

            // AMBIL DATA CHAT DARI CUSTOMER (Memuat relasi user dan product)
            $chats = \App\Models\Chat::with(['user', 'product'])->latest()->take(5)->get();

            // AMBIL DATA NOTIFIKASI PESANAN MASUK TERBARU
            $notifications = Order::with('user')->latest()->take(5)->get();

            $categoryOrderCounts = [
                'Korean Style' => Order::whereHas('product', function($q) { $q->where('category', 'like', '%korean%'); })->sum('quantity'),
                'Knitwear'     => Order::whereHas('product', function($q) { $q->where('category', 'like', '%knitwear%'); })->sum('quantity'),
                'Loungewear'   => Order::whereHas('product', function($q) { $q->where('category', 'like', '%loungewear%'); })->sum('quantity'),
                'Teen Fashion' => Order::whereHas('product', function($q) { $q->where('category', 'like', '%teen%'); })->sum('quantity'),
            ];

            $categories = Product::pluck('category')->unique();
            $dynamicCategoryData = [];
            foreach ($categories as $cat) {
                if ($cat) {
                    $sumQty = Order::whereHas('product', function($q) use ($cat) {
                        $q->where('category', $cat);
                    })->sum('quantity');
                    $dynamicCategoryData[$cat] = $sumQty;
                }
            }

            return view('admin.dashboard', compact(
                'totalUsers', 
                'totalCustomers', 
                'totalStores', 
                'totalProducts', 
                'totalOrders', 
                'totalRevenue', 
                'recentOrders',
                'chats',
                'notifications'  
 ));
        })->name('admin.dashboard');

        // Rute Daftar Pesanan Admin yang Mendukung Multi-Produk & Relasi Customer
        Route::get('/orders', function (Illuminate\Http\Request $request) {
            $query = Order::with(['orderItems.product', 'user', 'customer', 'product']);

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('id', 'like', '%' . $search . '%')
                      ->orWhere('invoice_number', 'like', '%' . $search . '%')
                      ->orWhere('payment_method', 'like', '%' . $search . '%')
                      ->orWhereHas('user', function ($u) use ($search) {
                          $u->where('name', 'like', '%' . $search . '%');
                      })
                      ->orWhereHas('customer', function ($c) use ($search) {
                          $c->where('name', 'like', '%' . $search . '%');
                      });
                });
            }

            $orders = $query->latest()->get();
            return view('admin.orders', compact('orders'));
        })->name('admin.orders');

        Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');
        Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

        Route::get('/products', function (Illuminate\Http\Request $request) {
            $query = Product::with('store');

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('category', 'like', '%' . $search . '%');
                });
            }

            $products = $query->latest()->get();
            return view('admin.products', compact('products'));
        })->name('admin.products');

        Route::get('/stores', function () {
            $stores = Store::with('user')->get();
            return view('admin.stores', compact('stores'));
        })->name('admin.stores');

        Route::get('/customers', function () {
            $customers = User::where('role', 'customer')->latest()->get();
            return view('admin.customers', compact('customers'));
        })->name('admin.customers');

        Route::get('/users', function () {
            $users = User::latest()->get();
            $admin = auth()->user();
            return view('admin.users', compact('users', 'admin'));
        })->name('admin.users');

        Route::get('/settings', function () {
            $admin = auth()->user();
            return view('admin.settings', compact('admin'));
        })->name('admin.settings');

        Route::post('/settings/update', function (\Illuminate\Http\Request $request) {
            $admin = auth()->user();
            $admin->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);
            return back()->with('success', 'Pengaturan sistem berhasil diperbarui!');
        })->name('admin.settings.update');

        Route::get('/admin/reviews', [App\Http\Controllers\OrderController::class, 'reviewsIndex'])->name('admin.reviews.index')->middleware(['auth', 'role:admin']);

        Route::get('/reports/pdf', [ReportController::class, 'exportSalesPDF'])->name('admin.reports.pdf');
        Route::get('/reports/excel', [ReportController::class, 'exportSalesExcel'])->name('admin.reports.excel');
        
    });

    // Seller Dashboard (Penjual)
    Route::middleware(['role:seller'])->prefix('seller')->group(function () {
        Route::get('/dashboard', function () {
            $userId = auth()->id();

            $products = Product::whereHas('store', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->latest()->paginate(6);

            if ($products->isEmpty()) {
                $products = Product::latest()->paginate(6);
            }

            $notifications = Order::whereHas('product.store', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->with(['customer', 'product'])->latest()->take(5)->get();

            if ($notifications->isEmpty()) {
                $notifications = Order::with(['customer', 'product'])->latest()->take(5)->get();
            }

            return view('seller.dashboard', compact('products', 'notifications'));
        })->name('seller.dashboard');

        Route::get('/users', function () {
            $user = auth()->user();
            return view('seller.users', compact('user'));
        })->name('seller.users');

        Route::get('/settings', function () {
            $user = auth()->user();
            $store = Store::where('user_id', $user->id)->first();
            return view('seller.settings', compact('user', 'store'));
        })->name('seller.settings');

        Route::post('/settings/update', function (\Illuminate\Http\Request $request) {
            $user = auth()->user();
            $user->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);
            return back()->with('success', 'Pengaturan akun berhasil diperbarui!');
        })->name('seller.settings.update');

        Route::get('/katalog', function () {
            $userId = auth()->id();
            $products = Product::whereHas('store', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->latest()->paginate(9);

            return view('seller.katalog', compact('products'));
        })->name('seller.katalog');

        Route::get('/products/create', function () {
            return view('seller.tambah-produk');
        })->name('seller.products.create');
        
        Route::post('/products', [ProductController::class, 'store'])->name('seller.products.store');
        Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('seller.products.edit');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('seller.products.update');
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('seller.products.destroy');
    });

    // Customer Routes (Pembeli)
    Route::middleware(['role:customer'])->group(function () {
        Route::get('/customer/dashboard', function (\Illuminate\Http\Request $request) {
            $query = Product::query();

            if ($request->filled('search')) {
                $query->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('category', 'like', '%' . $request->search . '%');
            }

            $products = $query->latest()->get();
            return view('customer.dashboard', compact('products'));
        })->name('customer.dashboard');

        Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('customer.orders');

        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
        Route::delete('/cart/remove/{id}', [CartController::class, 'destroy'])->name('cart.remove');

        Route::match(['get', 'post'], '/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
        Route::match(['get', 'post'], '/checkout/{id}', [CheckoutController::class, 'process'])->name('checkout');

        Route::post('/order/process', [OrderController::class, 'processOrder'])->name('order.process');
        Route::get('/orders/{id}/detail', [App\Http\Controllers\OrderController::class, 'showCustomerOrderDetail'])->name('customer.orders.show');

        Route::get('/orders/{id}/pdf', [OrderController::class, 'downloadPdf'])->name('orders.pdf');
        Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
        Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('order.updateStatus');

        // Route Penyimpanan Ulasan Produk
        Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');
        Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');
    });

});