<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ShipController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

//User login
Route::get('/', function () {
    $is_admin = false;
    return view('login', compact('is_admin'));
})->name('/');

Route::get('/privacy', function () {
    return view('privacy');
});

Route::get('/service', function () {
    return view('service');
});

//Admin login
Route::get('/admin-login', function () {
    $is_admin = true;
    return view('login', compact('is_admin'));
});

Route::post('/login', [LoginController::class, 'postLogin']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/forgot', [LoginController::class, 'postForgot']);

Route::get('/register', function () {
    return view('register');
});
Route::post('/register', [LoginController::class, 'register']);
Route::get('/verify', [LoginController::class, 'getVerify']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/setMember', [IndexController::class, 'setMember']);
    Route::get('/admin', [IndexController::class, 'admin']);
    Route::get('/member', [IndexController::class, 'member']);
    Route::get('/index', [IndexController::class, 'index']);

    Route::get('/test-import', function () {
        return view('test');
    });

    Route::post('/deposits/import', [DepositController::class, 'import']);
    Route::post('/stores/import', [StoreController::class, 'import']);
    Route::post('/transports/import', [TransportController::class, 'import']);
    Route::post('/ships/import', [ShipController::class, 'import']);

    Route::post('/test-upload', [TestController::class, 'upload']);
    Route::post('/attachments/upload', [AttachmentController::class, 'upload']);

    Route::resource('stores', StoreController::class);
    Route::resource('transports', TransportController::class);
    Route::resource('ships', ShipController::class);
    Route::resource('deposits', DepositController::class);
    Route::resource('attachments', AttachmentController::class);
});
Route::resource('users', UserController::class);
