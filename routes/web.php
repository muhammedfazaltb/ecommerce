<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('admin')->group(function() {
Route::group(['middleware' => 'admin'], function(){
    Route::get('home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home');
Route::get('shopcreate', [App\Http\Controllers\AdminController::class, 'createShop'])->name('create.shop');
Route::post('shopcreate', [App\Http\Controllers\AdminController::class, 'addShop'])->name('admin.addshop');
Route::get('shoplist', [App\Http\Controllers\AdminController::class, 'listShop'])->name('admin.listshop');
Route::get('editshop/{id}', [App\Http\Controllers\AdminController::class, 'editShop'])->name('admin.editshop');
Route::post('editshop', [App\Http\Controllers\AdminController::class, 'updateShop'])->name('admin.updateshop');
Route::post('post-data', [App\Http\Controllers\AdminController::class, 'adminPostManage'])->name('AdminPostManage');

Route::get('approvedproductlist', [App\Http\Controllers\AdminController::class, 'ApprovedproductList'])->name('product.approved');

Route::get('productlist', [App\Http\Controllers\AdminController::class, 'productList'])->name('product.list');
    });
});

Route::prefix('shop')->group(function() {
Route::group(['middleware' => 'shop'], function(){

Route::get('home', [App\Http\Controllers\HomeController::class, 'shopHome'])->name('shop.home');

Route::get('addcategory', [App\Http\Controllers\ShopController::class, 'addCategory'])->name('shop.addcategory');
Route::post('addcategory', [App\Http\Controllers\ShopController::class, 'createCategory'])->name('shop.createcategory');
Route::get('listcategory', [App\Http\Controllers\ShopController::class, 'listCategory'])->name('shop.listcategory');
Route::get('editcategory/{id}', [App\Http\Controllers\ShopController::class, 'editCategory'])->name('shop.editcategory');
Route::post('editcategory', [App\Http\Controllers\ShopController::class, 'updateCategory'])->name('shop.updatecategory');

Route::get('addbrand', [App\Http\Controllers\ShopController::class, 'addBrand'])->name('shop.addbrand');
Route::post('addbrand', [App\Http\Controllers\ShopController::class, 'createBrand'])->name('shop.createbrand');
Route::get('listbrand', [App\Http\Controllers\ShopController::class, 'listBrand'])->name('shop.listbrand');
Route::get('editbrand/{id}', [App\Http\Controllers\ShopController::class, 'editBrand'])->name('shop.editbrand');
Route::post('editbrand', [App\Http\Controllers\ShopController::class, 'updateBrand'])->name('shop.updatebrand');
Route::get('addproduct', [App\Http\Controllers\ShopController::class, 'addProduct'])->name('shop.addproduct');
Route::post('post-data', [App\Http\Controllers\ShopController::class, 'shopPostManage'])->name('ShopPostManage');
Route::post('addproductsubmit', [App\Http\Controllers\ShopController::class, 'createProduct'])->name('shop.createproduct');
Route::get('listproduct', [App\Http\Controllers\ShopController::class, 'listProduct'])->name('shop.listproduct');    

});
});



