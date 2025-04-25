<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;

Route::get('/', fn() => redirect('/barang'));

Route::resource('barang', BarangController::class);
Route::resource('barang-masuk', BarangMasukController::class);
Route::resource('barang-keluar', BarangKeluarController::class);
