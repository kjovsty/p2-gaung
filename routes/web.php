<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('pengaduan', PengaduanController::class);

Route::get('login', [LoginController::class , 'view'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class,'proses'])->name('login.proses')->middleware('guest');

Route::get('logout', [LoginController::class, 'logout'])->name('logout.petugas');

Route::get('/dashboard/admin',[DashboardController::class,'admin'])->name('dashboard.admin')->middleware('auth', 'level:admin');
Route::get('/dashboard/petugas', [DashboardController::class, 'petugas'])->name('dashboard.petugas')->middleware('auth');
Route::get('/dashboard/masyarakat', [DashboardController::class, 'masyarakat'])->name('dashboard.masyarakat')->middleware('auth');

Route::post('register', [RegisterController::class, 'view'])->name('register')->middleware(('guest'));
Route::get('register', [RegisterController::class, 'store'])->name('register-store')->middleware(('guest'));
 
Route::post('pengaduan/{pengaduan}/tanggapan', [TanggapanController::class, 'create'])->name('tanggapan.create');
Route::get('pengaduan/{pengaduan}', [TanggapanController::class, 'store'])->name('tanggapan.store');

Route::view('error/403', 'error.403')->name ('error.403');

Route::get('user', [UserController::class, 'index']);
Route::get('generatepdf', [UserController::class, 'generatepdf'])->name('user.pdf');