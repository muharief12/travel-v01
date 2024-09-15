<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PackageBankController;
use App\Http\Controllers\PackageBookingController;
use App\Http\Controllers\PackageTourController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/category/{category:slug}', [FrontController::class, 'category'])->name('front.category');
Route::get('/detail/{packageTour:slug}', [FrontController::class, 'detail'])->name('front.detail');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('can:checkout package')->group(function () {
       Route::get('/booking/{packageTour:slug}', [FrontController::class, 'booking'])->name('front.booking');
       Route::post('/booking/save/{packageTour:slug}', [FrontController::class, 'booking_store'])->name('front.booking_store');
       Route::get('/booking/choose_bank/{packageBooking}', [FrontController::class, 'choose_bank'])->name('front.choose_bank');
       Route::patch('booking/save/{packageBooking}', [FrontController::class, 'choose_bank_store'])->name('front.choose_bank.store');
       Route::get('/booking/payment/{packageBooking}', [FrontController::class, 'booking_payment'])->name('front.booking_payment');
       Route::patch('/booking/payment/save/{packageBooking}', [FrontController::class, 'booking_payment_store'])->name('front.booking_payment_store');
       Route::get('/booking-finish', [FrontController::class, 'booking_finish'])->name('front.booking_finish');
    });

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::middleware('can:view orders')->group( function () {
           Route::get('/my-bookings', [DashboardController::class, 'my_bookings'])->name('bookings');
           Route::get('my-bookings/detail/{packageBookings}', [DashboardController::class, 'booking_detail'])->name('bookings.detail');
        });
    });

    Route::prefix('admin')->name('admin.')->group(function (){
        Route::middleware('can:manage categories')->group(function () {
            Route::resource('categories', CategoryController::class);
        });
        Route::middleware('can:manage packages')->group(function () {
            Route::resource('package_tours', PackageTourController::class);
        });
        Route::middleware('can:manage bookings')->group(function () {
            Route::resource('package_bookings', PackageBookingController::class); 
        });
    });
});

require __DIR__.'/auth.php';
