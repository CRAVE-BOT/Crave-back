<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CalroiesController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\FavouriteController;
use App\Http\Controllers\API\MessageController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\SuggestController;
use App\Http\Controllers\API\TableController;
use App\Http\Controllers\API\TablereserveController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\Theme\AnalyticsController;
use Illuminate\Http\Request;
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
//Auth Controller
Route::controller(AuthController::class)->group(function () {
   Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
    Route::post('/Logout', 'logout')->name('logout')->middleware('auth:sanctum');
});

//Chat boot
Route::post('/chatbot', [ChatbotController::class, 'handleMessage']);
Route::get('/chatbot/questions', [ChatbotController::class, 'getQuestions']);

// Category Controller
Route::controller(CategoryController::class)->group(function () {
   Route::get('categories', 'index')->name('categories.index');
});

// Product Controller
Route::controller(ProductController::class)->group(function () {
Route::get('/products/{category}', 'getProductsByCategory');
    Route::get('/products_3/{category}', 'get3ProductsByCategory');

});

//Message Controller
Route::controller(MessageController::class)->group(function () {
    Route::post('/messages', 'index')->name('messages.store');
});

//Table Controller
Route::controller(TableController::class)->group(function () {
    Route::get('/tables', 'index')->name('tables.index');
});

//Table_reserve
Route::controller(TablereserveController::class)->middleware('auth:sanctum')->group(function () {
   Route::post('table_reserve', 'store')->name('table_reserves.store');
    Route::get('table_reserve/latest', 'last_reserve')->name('table_reserves.latest');

});

//favourite controller
Route::controller(FavouriteController::class)->middleware('auth:sanctum')->group(function () {
   Route::get('favourite', 'show')->name('favourite.get');
   Route::post('favourite_store', 'store')->name('favourite.store');
   Route::post('favourite_delete', 'delete')->name('favourite.delete');

});
//calories controller
Route::controller(CalroiesController::class)->middleware('auth:sanctum')->group(function () {
    Route::post('calories', 'show')->name('calories.get');
    Route::post('calories_store', 'store')->name('calories.store');
    Route::post('calories_taked', 'showTodayCalories')->name('calories_taked_.get');

});
//Suggest controller
Route::controller(SuggestController::class)->middleware('auth:sanctum')->group(function () {
    Route::post('suggest', 'show')->name('suggest.show');
});

//Order Contoller
Route::controller(OrderController::class)->middleware('auth:sanctum')->group(function () {
    Route::post('orders', 'store')->name('orders.store');
    Route::post('order_history', 'show')->name('orders.history');
});


//Analytics
Route::controller(AnalyticsController::class)->group(function () {
     Route::get('/chart-data','getChartData');
    Route::get('/Crave-analytics', [AnalyticsController::class, 'getDashboardStats']);

});

Route::post('/login/google', [GoogleAuthController::class, 'loginWithGoogle']);


