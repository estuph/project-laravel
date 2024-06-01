<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login/process', [AuthController::class, 'login_process'])->name('login.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register/process', [AuthController::class, 'register_process'])->name('register.process');

// Routes admin
Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminIndex'])->name('admin.dashboard');

    // Route User
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Route Product 
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Route Variant 
    Route::get('/variants', [VariantController::class, 'index'])->name('variants.index');
    Route::get('/variants/create', [VariantController::class, 'create'])->name('variants.create');
    Route::post('/variants', [VariantController::class, 'store'])->name('variants.store');
    Route::get('/variants/{variant}', [VariantController::class, 'show'])->name('variants.show');
    Route::get('/variants/{variant}/edit', [VariantController::class, 'edit'])->name('variants.edit');
    Route::put('/variants/{variant}', [VariantController::class, 'update'])->name('variants.update');
    Route::delete('/variants/{variant}', [VariantController::class, 'destroy'])->name('variants.destroy');

    // Route Supplier 
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('/suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
    Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::get('/suppliers/{supplier}', [SupplierController::class, 'show'])->name('suppliers.show');
    Route::get('/suppliers/{supplier}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::put('/suppliers/{supplier}', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');

    // Route Pengeluaran
    Route::get('/pengeluarans', [PengeluaranController::class, 'index'])->name('pengeluarans.index');
    Route::get('/pengeluarans/create', [PengeluaranController::class, 'create'])->name('pengeluarans.create');
    Route::post('/pengeluarans', [PengeluaranController::class, 'store'])->name('pengeluarans.store');
    Route::get('/pengeluarans/{pengeluaran}', [PengeluaranController::class, 'show'])->name('pengeluarans.show');
    Route::get('/pengeluarans/{pengeluaran}/edit', [PengeluaranController::class, 'edit'])->name('pengeluarans.edit');
    Route::put('/pengeluarans/{pengeluaran}', [PengeluaranController::class, 'update'])->name('pengeluarans.update');
    Route::delete('/pengeluarans/{pengeluaran}', [PengeluaranController::class, 'destroy'])->name('pengeluarans.destroy');

    // Route Laporan 
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::post('/laporan/generate', [LaporanController::class, 'generateReport'])->name('laporan.generate');
    Route::post('/laporan/print', [LaporanController::class, 'printReport'])->name('laporan.print');
});

// Routes amin dan kasir
Route::middleware(['auth', 'role:admin,kasir'])->group(function() {
    Route::get('/kasir/dashboard', [DashboardController::class, 'kasirIndex'])->name('kasir.dashboard');

    // Route Penjualan
    Route::get('/penjualans', [PenjualanController::class, 'index'])->name('penjualans.index');
    Route::get('/penjualans/create', [PenjualanController::class, 'create'])->name('penjualans.create');
    Route::post('/penjualans', [PenjualanController::class, 'store'])->name('penjualans.store');
    Route::get('/penjualans/{penjualan}', [PenjualanController::class, 'show'])->name('penjualans.show');
    Route::get('/penjualans/{penjualan}/edit', [PenjualanController::class, 'edit'])->name('penjualans.edit');
    Route::put('/penjualans/{penjualan}', [PenjualanController::class, 'update'])->name('penjualans.update');
    Route::delete('/penjualans/{penjualan}', [PenjualanController::class, 'destroy'])->name('penjualans.destroy');
    Route::get('penjualans/print/{id}', [PenjualanController::class, 'print'])->name('penjualans.print');

    // Route Pembelian
    Route::get('/pembelians', [PembelianController::class, 'index'])->name('pembelians.index');
    Route::get('/pembelians/create', [PembelianController::class, 'create'])->name('pembelians.create');
    Route::post('/pembelians', [PembelianController::class, 'store'])->name('pembelians.store');
    Route::get('/pembelians/{pembelian}', [PembelianController::class, 'show'])->name('pembelians.show');
    Route::get('/pembelians/{pembelian}/edit', [PembelianController::class, 'edit'])->name('pembelians.edit');
    Route::put('/pembelians/{pembelian}', [PembelianController::class, 'update'])->name('pembelians.update');
    Route::delete('/pembelians/{pembelian}', [PembelianController::class, 'destroy'])->name('pembelians.destroy');
});






