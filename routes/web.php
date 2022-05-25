<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TestController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\DashboardController;



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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/PerformTesting', [TestController::class, 'index'])->middleware(['auth'])->name('PerformTesting');

Route::post('/saveTest', [TestController::class, 'save'])->middleware(['auth'])->name('saveTest');

Route::get('/results', [TestController::class, 'test'])->middleware(['auth']);

Route::get('/history', [HistoryController::class, 'getAllHistoryData'])->middleware(['auth'])->name('history');

require __DIR__.'/auth.php';
