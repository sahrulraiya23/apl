<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;

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





Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/', [BarangController::class, 'index'])->name('index');

// Menampilkan form tambah barang (create)
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');

// Menyimpan data barang baru (store)
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');

// Route untuk update data barang
Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
// Route untuk menghapus barang
Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');


Route::get('kategori', [BarangController::class, 'indexKategori'])->name('kategori.index');
Route::get('kategori/create', [BarangController::class, 'createKategori'])->name('kategori.create');
Route::post('kategori', [BarangController::class, 'storeKategori'])->name('kategori.store');
Route::get('kategori/{id}/edit', [BarangController::class, 'editKategori'])->name('kategori.edit');
Route::put('kategori/{id}', [BarangController::class, 'updateKategori'])->name('kategori.update');
Route::delete('kategori/{id}', [BarangController::class, 'destroyKategori'])->name('kategori.destroy');



Route::get('barang/export-xml', [BarangController::class, 'exportBarangToXml'])->name('barang.exportXml');
Route::post('barang/import-xml', [BarangController::class, 'importXml'])->name('barang.importXml');
