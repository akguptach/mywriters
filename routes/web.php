<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController as Auth;
use App\Http\Controllers\SignupController as Signup;
use App\Http\Controllers\Tutor_UserController as Tutor_User;
use App\Http\Controllers\AccountinfoController as Account_Info;
use App\Http\Controllers\AddressController as Address;
use App\Http\Controllers\EducationController as Education;
use App\Http\Controllers\BankController as Bank;
use App\Http\Controllers\KycController as Kyc_detail;
use App\Http\Controllers\OrderController as Orders;
use App\Http\Controllers\OrderRequestController;
use App\Http\Controllers\HomeController as Home;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
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

/*Route::get('/', function () {
    return view('login');
})->name('home');*/

Route::get('/', [Home::class, 'index'])->name('home');

Route::get('/login', function () {
    return view('login');
});
Route::get('/home', function () {
    return view('login');
});

Route::get('/forgot_password', function () {
    return view('forgot_password');
})->name('forgot_password');
Route::get('/signup', [Signup::class, 'index'])->name('signup');
Route::post('/signup', [Signup::class, 'store'])->name('signup');
Route::post('/tutor_forgot_password', [Signup::class, 'forgot_password'])->name('tutor_forgot_password');

Route::post('/login', [Auth::class, 'login'])->name('login');
Route::middleware('auth')->group(function () {
    Route::resource('/tutor_user', Tutor_User::class)->except('show');
    Route::get('/dashboard', [Account_Info::class, 'dashboard'])->name('dashboard');
    Route::get('/account_info', [Account_Info::class, 'index'])->name('account_info');
    Route::post('/account_info', [Account_Info::class, 'store'])->name('account_info');
    Route::get('/address', [Address::class, 'index'])->name('address');
    Route::post('/address', [Address::class, 'store'])->name('address');
    Route::get('/education', [Education::class, 'index'])->name('education');
    Route::post('/education', [Education::class, 'store'])->name('education');
    Route::get('/bank', [Bank::class, 'index'])->name('bank');
    Route::post('/bank', [Bank::class, 'store'])->name('bank');
    Route::get('/kyc', [Kyc_detail::class, 'index'])->name('kyc');
    Route::post('/kyc', [Kyc_detail::class, 'store'])->name('kyc');
    Route::get('/account_order', [Orders::class, 'account'])->name('account_order');
    Route::get('/completed_order', [Orders::class, 'completed'])->name('completed_order');
    Route::get('/open_order', [Orders::class, 'open'])->name('open_order');


    Route::get('/request/pending/{type}', [OrderRequestController::class, 'pending'])->name('pending_request');
    Route::get('/request/details/{id}', [OrderRequestController::class, 'details'])->name('request_details');
    Route::post('/request/details/{id}', [OrderRequestController::class, 'details'])->name('request_details');

    Route::post('/request/accept', [OrderRequestController::class, 'requestAccept'])->name('request_accept');

    Route::post('/request/submit/budget/{id}', [OrderRequestController::class, 'submitFinalBudget'])->name('submit_budget');

    Route::post('/request/submit/final/{id}', [OrderRequestController::class, 'submitFinalDocument'])->name('submit_final');


    Route::get('/logout', [Auth::class, 'logout'])->name('logout');
});
