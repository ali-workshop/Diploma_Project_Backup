<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\Admin\adminController;
use App\Http\Controllers\ReservationController;

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
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'role:admin']], function () {
Route::get('/dashboard', [adminController::class, 'index'])->name('dashboard');
Route::resource('/services', ServicesController::class);
Route::resource('/messages', MessageController::class);
Route::resource('/rooms', RoomController::class);
Route::resource('/roomType', RoomTypeController::class);
Route::resource('/reservation', ReservationController::class);
// Route::get('rooms/avaliable', [RoomController::class,'showAvaliableRoom'])->name('rooms.avaliable');
// Route::get('rooms/available', [RoomController::class, 'showAvailableRoom'])->name('rooms.available');
// Route::get('test', function () {
//     return 'Test Route is working!';
// })->name('room.test');
 // Ensure this route is correct
 Route::get('test', [RoomController::class, 'showAvailableRoom'])->name('rooms.availablealolaa');

 // Test rout
});
// Route::get('/rooms/avaliable', [RoomController::class,'showAvaliableRoom'])->name('rooms.avaliable');
// Route::get('rooms/available', [RoomController::class, 'showAvailableRoom'])->name('rooms.available');
// Route::get('test', function () {
//     return 'Test Route is working!';
// })->name('room.test');