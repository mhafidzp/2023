<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ScrapeController;

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
Route::get('/layout', function () {
    return view('layouts.index');
});

Route::get('/coba', [ScrapeController::class, 'coba']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//ADMIN
Route::get('/admin/login', [AdminController::class, 'formLogin'])->name('admin.form.login');
Route::post('/admin/post-login', [AdminController::class, 'login'])->name('admin.login');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::group(['middleware'=>'admin'], function() {

    Route::group(['prefix' => 'admin'], function (){
        Route::get('/', [Admincontroller::class, 'userAdmin'])->name('admin.user');
        Route::get('/create', [AdminController::class, 'create'])->name('create.admin');
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/cek-email', [AdminController::class, 'cekEmail'])->name('cek-email.admin');
        Route::post('/store', [AdminController::class, 'store'])->name('store.admin');
        Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('edit.admin');
        Route::post('/{id}/update', [AdminController::class, 'update'])->name('update.admin');
        Route::post('/{id}/destroy', [AdminController::class, 'destroy'])->name('destroy.admin');
        //provinsi
        Route::get('/provinsi', [ProvinsiController::class, 'index'])->name('index.provinsi');
        Route::get('/provinsi/create', [ProvinsiController::class, 'create'])->name('create.provinsi');
        Route::post('/provinsi/store', [ProvinsiController::class, 'store'])->name('store.provinsi');
        Route::get('/provinsi/{id}/edit', [ProvinsiController::class, 'edit'])->name('edit.provinsi');
        Route::post('/provinsi/update', [ProvinsiController::class, 'update'])->name('update.provinsi');
        Route::post('/provinsi/{id}/destroy', [ProvinsiController::class, 'destroy'])->name('destroy.provinsi');
        Route::get('/provinsi/cek-kode', [ProvinsiController::class, 'cekKode'])->name('cek-kode.provinsi');
        //kotakab
        Route::get('/kota', [KotaController::class, 'index'])->name('index.kota');
        Route::get('/kota/create', [KotaController::class, 'create'])->name('create.kota');
        Route::post('/kota/store', [KotaController::class, 'store'])->name('store.kota');
        Route::get('/kota/{id}/edit', [KotaController::class, 'edit'])->name('edit.kota');
        Route::post('/kota/{id}/update', [KotaController::class, 'update'])->name('update.kota');
        Route::post('/kota/{id}/destroy', [KotaController::class, 'destroy'])->name('destroy.kota');
        Route::get('/kota/select', [KotaController::class, 'select'])->name('select.kota');
        Route::get('/kota/cek-kode', [KotaController::class, 'cekKode'])->name('cek-kode.kota');
        //kecamatan
        Route::get('/kecamatan', [KecamatanController::class, 'index'])->name('index.kecamatan');
        Route::get('/kecamatan/create', [KecamatanController::class, 'create'])->name('create.kecamatan');
        Route::post('/kecamatan/store', [KecamatanController::class, 'store'])->name('store.kecamatan');
        Route::get('/kecamatan/{id}/edit', [KecamatanController::class, 'edit'])->name('edit.kecamatan');
        Route::post('/kecamatan/{id}/update', [KecamatanController::class, 'update'])->name('update.kecamatan');
        Route::post('/kecamatan/{id}/destroy', [KecamatanController::class, 'destroy'])->name('destroy.kecamatan');
        Route::get('/kecamatan/select', [KecamatanController::class, 'select'])->name('select.kecamatan');
        //kelurahan
        Route::get('/kelurahan', [KelurahanController::class, 'index'])->name('index.kelurahan');
        Route::get('/kelurahan/create', [KelurahanController::class, 'create'])->name('create.kelurahan');
        Route::post('/kelurahan/store', [KelurahanController::class, 'store'])->name('store.kelurahan');
        Route::get('/kelurahan/{id}/edit', [KelurahanController::class, 'edit'])->name('edit.kelurahan');
        Route::post('/kelurhan/{id}/update', [KelurahanController::class, 'update'])->name('update.kelurahan');
        Route::post('/kelurahan/{id}/destroy', [KelurahanController::class, 'destroy'])->name('destroy.kelurahan');
        //user
        Route::get('/user', [UserController::class, 'index'])->name('index.user');
        Route::get('/user/create', [UserController::class, 'create'])->name('create.user');
        Route::post('/user/store', [UserController::class, 'store'])->name('store.user');
        Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('edit.user');
        Route::post('/user/{id}/update', [UserController::class, 'update'])->name('update.user');
        Route::post('/user/{id}/destroy', [UserController::class, 'destroy'])->name('destroy.user');
        Route::get('/user/cek-email', [UserController::class, 'cekEmail'])->name('cek-email.user');
    });

});

Route::group(['middleware' => 'web'], function() {
    Route::group(['prefix' => 'user'], function() {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard.user');
    });
});
