<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Bookings\TableBookingController;
use App\Http\Controllers\Api\Catalog\CategoryController;
use App\Http\Controllers\Api\Catalog\MenuItemController;
use App\Http\Controllers\Api\Commerce\CartController;
use App\Http\Controllers\Api\Commerce\OrderController;
use App\Http\Controllers\Api\System\NotificationController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/menu', [MenuItemController::class, 'index']);
Route::get('/menu/{menuItem}', [MenuItemController::class, 'show']);
Route::get('/categories', [CategoryController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::put('/profile', [AuthController::class, 'updateProfile']);

    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart', [CartController::class, 'addItem']);
    Route::delete('/cart/{cartItem}', [CartController::class, 'removeItem']);
    Route::put('/cart/{cartItem}', [CartController::class, 'updateItem']);

    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/my-orders', [OrderController::class, 'myOrders']);

    Route::post('/bookings', [TableBookingController::class, 'store']);
    Route::get('/my-bookings', [TableBookingController::class, 'myBookings']);

    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::put('/notifications/{id}/read', [NotificationController::class, 'markRead']);
    Route::put('/notifications/read-all', [NotificationController::class, 'markAllRead']);

    Route::middleware('admin')->group(function () {
        Route::post('/menu', [MenuItemController::class, 'store']);
        Route::put('/menu/{menuItem}', [MenuItemController::class, 'update']);
        Route::delete('/menu/{menuItem}', [MenuItemController::class, 'destroy']);

        Route::post('/categories', [CategoryController::class, 'store']);
        Route::put('/categories/{category}', [CategoryController::class, 'update']);
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

        Route::get('/orders', [OrderController::class, 'index']);
        Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus']);

        Route::get('/bookings', [TableBookingController::class, 'index']);
        Route::put('/bookings/{tableBooking}/status', [TableBookingController::class, 'updateStatus']);

        Route::get('/users', [AuthController::class, 'users']);
        Route::put('/users/{user}/role', [AuthController::class, 'updateRole']);
    });
});
