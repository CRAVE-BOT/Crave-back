<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Theme\CategoryController;
use App\Http\Controllers\Theme\IndexController;
use App\Http\Controllers\Theme\InvetoryController;
use App\Http\Controllers\Theme\MessageController;
use App\Http\Controllers\Theme\OrderController;
use App\Http\Controllers\Theme\ProductController;
use App\Http\Controllers\Theme\StaffController;
use App\Http\Controllers\Theme\Table_reserveController;
use App\Http\Controllers\Theme\TableController;
use App\Http\Controllers\Theme\UserController;
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
// our app
Route::controller(IndexController::class)->group(function () {
    Route::get('/Crave','index')->middleware(['auth', 'verified'])->name('welcome');
    Route::get('/','index')->middleware(['auth', 'verified']);

});

//Order Controller
Route::controller(OrderController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/Order','index')->name('Orders.index');
    Route::get('/Order_show/{order}','show')->name('Orders.show');
    Route::delete('/Order_delete/{order}','destroy')->name('Orders.delete');
});


// Category controller
Route::controller(CategoryController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/Category','index')->name('Category.index');
    Route::get('Category_create','create')->name('Category.create');
    Route::Post('Category_store','store')->name('Category.store');
    Route::delete('Category_delete/{category}','destroy')->name('Category.delete');
    Route::get('Category_edit/{category}','edit')->name('Category.edit');
    Route::put('Category_update/{category}','update')->name('Category.update');


});



// Table Controller
Route::controller(TableController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/Table','index')->name('Table.index');
    Route::get('/Table_create','create')->name('Table.create');
    Route::Post('/Table_store','store')->name('Table.store');
    Route::get('/Table_edit/{table}', 'edit')->name('Table.edit');
    Route::put('/Table_update/{table}','update')->name('Table.update');
    Route::delete('/Table_delete/{table}','destroy')->name('Table.delete');





});
// Table Reserve
Route::controller(Table_reserveController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/Table_reserve','index')->name('Table_reserve.index');
    Route::delete('/Table_reserve_delete/{tablereserve}','destroy')->name('Table.reserve.delete');





});


//Product Controller
Route::controller(ProductController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/Product','index')->name('Product.index');
    Route::get('/Product_create','create')->name('Product.create');
    Route::Post('/Product_store','store')->name('Product.store');
    Route::post('/Product_edit','edit')->name('Product.edit');
    Route::post('/Product_delete','destroy')->name('Product.delete');
    Route::post('/Product_update','update')->name('Product.update');

});


//Invetory Controller

Route::controller(InvetoryController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/Inventory','index')->name('Inventory.index');
    Route::get('/Inventory_create','create')->name('Inventory.create');
    Route::Post('/Inventory_store','store')->name('Inventory.store');
    Route::get('/Inventory_edit/{inventory}', 'edit')->name('Inventory.edit');
    Route::put('/Inventory_update/{inventory}', 'update')->name('Inventory.update');
    Route::delete('/inventory_delete/{inventory}','destroy')->name('Inventory.delete');

});

//Staff Controller
Route::controller(StaffController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/Staff','index')->name('Staff.index');
    Route::get('/Staff_create','create')->name('Staff.create');
    Route::Post('/Staff_store','store')->name('Staff.store');
    Route::delete('Staff_delete/{staff}','destroy')->name('Staff.delete');
    Route::get('Staff_edit/{staff}','edit')->name('Staff.edit');
    Route::put('Staff_update/{staff}','update')->name('Staff.update');

});


//User Controller
Route::controller(UserController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/User','index')->middleware(['auth', 'verified'])->name('User.index');
    Route::post('/User_delete','destroy')->name('user.delete');
});


//Messages Contoller
Route::controller(MessageController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/Message','index')->middleware(['auth', 'verified'])->name('Message.index');
    Route::post('/Message_delete','destroy')->name('message.delete');

});
//Analythis
Route::view('analythis','Theme.Analysis.analythis')->middleware(['auth', 'verified'])->name('analythis.index');






// Edit profile user
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
