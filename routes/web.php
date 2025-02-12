<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\LabaRugiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SatuanBarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\TransaksiPosController;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [\App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::post('users', [\App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
    Route::get('users/search', [\App\Http\Controllers\UserController::class, 'search'])->name('users.search');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::controller(RoleController::class)->group(function () {
        Route::get('roles', 'index')->name('roles.index');
        Route::get('roles/create', 'create')->name('roles.create');
        Route::post('roles', 'store')->name('roles.store');
        Route::get('roles/{role}/edit', 'edit')->name('roles.edit');
        Route::put('roles/{role}', 'update')->name('roles.update');
        Route::delete('roles/{role}', 'destroy')->name('roles.destroy');
        Route::get('roles/search', 'roleSearch')->name('roles.search');
    });

    Route::resource('supplier', SupplierController::class);
    Route::resource('jenis-barang', JenisBarangController::class);
    Route::resource('satuan-barang', SatuanBarangController::class);
    Route::resource('barang', BarangController::class);
    // Route::get('pos/customer', [PosController::class, 'customer'])->name('pos.customer');
    // Route::post('pos/set-customer', [PosController::class, 'setCustomer'])->name('pos.setCustomer');
    // Route::post('pos/clear-customer', [PosController::class, 'clearCustomer'])->name('pos.clearCustomer');
    // Route::resource('pos', PosController::class)->only(['index', 'store', 'destroy']);
    // Route::post('pos/checkout', [PosController::class, 'checkout'])->name('pos.checkout');
    // Route::get('transaksi-pos', [TransaksiPosController::class, 'index'])->name('transaksi-pos.index');
    Route::get('laba-rugi', [LabaRugiController::class, 'index'])->name('laba-rugi.index');
});

Route::middleware(['auth', 'role:admin|kasir'])->group(function () {

    Route::get('pos/customer', [PosController::class, 'customer'])->name('pos.customer');
    Route::post('pos/set-customer', [PosController::class, 'setCustomer'])->name('pos.setCustomer');
    Route::post('pos/clear-customer', [PosController::class, 'clearCustomer'])->name('pos.clearCustomer');
    Route::resource('pos', PosController::class)->only(['index', 'store', 'destroy']);
    Route::post('pos/checkout', [PosController::class, 'checkout'])->name('pos.checkout');
    Route::get('transaksi-pos', [TransaksiPosController::class, 'index'])->name('transaksi-pos.index');
});
