<?php

use Tasawk\Http\Controllers\OrderServices;
use Tasawk\Notifications\SendAdminMessagesNotification;
use Tasawk\Settings\ThirdPartySettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->group(function (){
    Route::post('profile/orders/{order}/session/join', action: [OrderServices::class, 'join'])->middleware([]);
    Route::post('profile/orders/{order}/session/left', [OrderServices::class, 'left'])->middleware([]);
    Route::post('profile/orders/{order}/session/end', [OrderServices::class, 'end'])->middleware([]);
});



