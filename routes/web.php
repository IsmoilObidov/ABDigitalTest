<?php

use App\Exceptions\TelegramExceptionHandler;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\TwoFactorController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Api;

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
})->name('dashboard');


Route::get('/register', [Controller::class, 'view_register']);

Route::get('/login', [Controller::class, 'view_login'])->name('view_login');

Route::post('/register', [Controller::class, 'register'])->name('register');

Route::post('/login', [Controller::class, 'login'])->name('login');


Route::get('/reset', [ResetPasswordController::class, 'reset'])->name('reset');

Route::post('/reset/verify', [ResetPasswordController::class, 'verification'])->name('reset.verify');

Route::get('/veiw_reset/{id}', [ResetPasswordController::class, 'veiw_reset_password'])->name('reset.view-reset-password');

Route::post('/reset-password/{id}', [ResetPasswordController::class, 'reset_password'])->name('reset.reset-password');


Route::middleware(['auth'])->group(function () {

    Route::middleware(['twofactor'])->group(function () {
        Route::view('/admin', 'admin.index');
    });

    Route::get('/logout', [Controller::class, 'logout'])->name('logout');

    Route::get('verify/resend', [TwoFactorController::class, 'resend'])->name('verify.resend');

    Route::resource('verify', TwoFactorController::class)->only(['index', 'store']);
});



Route::get('/test1', function () {
    $exception = new Exception("Тестовая критическая ошибка");
    

    return "Уведомление отправлено в Telegram";


});
