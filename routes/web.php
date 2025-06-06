<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\SettingController;

Route::get('/', function () {
    return redirect('/dashboard');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard-data', [DashboardController::class, 'getData']);


Route::get('/history', [HistoryController::class, 'index'])->name('history');
Route::post('/history/store', [HistoryController::class, 'storeSensorData']);




// routes/web.php
Route::get('/setting', [SettingController::class, 'index']);
Route::post('/setting/jadwal', [SettingController::class, 'simpanJadwal']);
