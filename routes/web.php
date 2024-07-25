<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\PengajuanSKHPN;
use App\Http\Controllers\PermohonanNarasumber;
use App\Http\Controllers\PermohonanNarasumberController;

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
    return view('welcome');
});

Route::get('/beranda', [HomeController::class, 'beranda'])->name('beranda');
Route::get('/dashboard', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/admin/laporan_narasumber', [AdminController::class,'laporan_narasumber'])->name('admin.laporan_narasumber');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
Route::get('/pengaduan/form', [PengaduanController::class, 'form'])->name('pengaduan.form');
Route::get('/permohonan', [PermohonanController::class, 'index'])->name('permohonan.index');

Route::get('/permohonan/pengajuan_skhpn', [PengajuanSKHPN::class,'index'])->name('pengajuan_skhpn.index');

//permohonan narasumber
Route::get('/permohonan/permohonan_narasumber', [PermohonanNarasumberController::class,'index'])->name('permohonan_narasumber.index');
Route::post('/permohonan-narasumber', [PermohonanNarasumberController::class,'store'])->name('submit.request');
Route::get('/permohonan-narasumber/{id}',[PermohonanNarasumberController::class,'show'])->name('permohonan.show');


//admin
Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin_dashboard');

require __DIR__.'/auth.php';