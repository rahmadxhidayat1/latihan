<?php
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeControllers;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionDetailController;
use App\Models\Student;
use App\Models\Major;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\MockObject\Builder\Stub;

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

Route::get('/',[HomeControllers::class, 'home'])->name('home');
Route::get('/tentang kami',[HomeControllers::class, 'about'])->name('about');
Route::get('/kontak',[HomeControllers::class, 'contact'])->name('contact');
Route::get('/layanan',[HomeControllers::class, 'service'])->name('service');
Route::get('/harga',[HomeControllers::class, 'price'])->name('price');
Route::get('/transaction', [TransactionController::class, 'store']);

// untuk mengeluarkan list data
// Route::get('/student', [StudentController::class, 'index']);
// // untuk mengeluarkan form view insert
// Route::get('/student/create', [StudentController::class, 'create']);
// // untuk mengeluarkan form view update
// Route::get('/student/{id}/edit', [StudentController::class, 'edit']);
// // untuk menyimpan
// Route::post('/student', [StudentController::class, 'store']);
// // untuk edit
// Route::put('/student/{id}', [StudentController::class, 'update']);
// // untuk delete
// Route::delete('/student/{id}', [StudentController::class, 'destroy']);

//mewakili yang diatas
Route::resource('student', StudentController::class);
Route::resource('major', MajorController::class);
