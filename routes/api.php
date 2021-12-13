<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('test_api', function () {
  echo("welcome to my api");
});

//one user logout
Route::get('users/logout', [\App\Http\Controllers\UserController::class, 'UserLogout']);

//test of notifying all user require change in method to see notification tokens
Route::get('users/notify', [\App\Http\Controllers\UserController::class, 'NotifyAllUsers']);

//one user login
Route::post('/users/login', [\App\Http\Controllers\UserController::class, 'UserLogin']);

//one user register
Route::post('/users/register', [\App\Http\Controllers\UserController::class, 'store']);

//get all users
Route::get('/users', [\App\Http\Controllers\UserController::class, 'index']);

//post one product
Route::post('/products', [\App\Http\Controllers\ProductController::class, 'store']);
//update one product
Route::post('/products/{id}', [\App\Http\Controllers\ProductController::class, 'update']);
//edit whole product
Route::post('/products/{id}/{field}', [\App\Http\Controllers\ProductController::class, 'edit']);
//delete one product
Route::delete('/products/{id}', [\App\Http\Controllers\ProductController::class, 'destroy']);

//post one category
Route::post('/categories', [\App\Http\Controllers\CategoryController::class, 'store']);
//update one category
Route::post('/categories/{id}', [\App\Http\Controllers\CategoryController::class, 'update']);
//edit one category
Route::post('/categories/{id}/{field}', [\App\Http\Controllers\CategoryController::class, 'edit']);
//delete one category
Route::delete('/categories/{id}', [\App\Http\Controllers\CategoryController::class, 'destroy']);

//get all orders
Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'index']);
//get one order by id
Route::get('/orders/{id}', [\App\Http\Controllers\OrderController::class, 'show']);
//update one order
Route::post('/orders/{id}', [\App\Http\Controllers\OrderController::class, 'update']);
//edit one order
Route::post('/orders/{id}/{field}', [\App\Http\Controllers\OrderController::class, 'edit']);

Route::middleware(['auth:api'])->group(function () {
  Route::get('/user', function (Request $request) {
    return $request->user();
  });

  //get all categories
  Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index']);

  //get a category with id
  Route::get('/categories/{id}', [\App\Http\Controllers\CategoryController::class, 'show']);

  //get all products with category id
  Route::get('/productsOfCategory/{id}', [\App\Http\Controllers\CategoryController::class, 'ShowProductsOfCategory']);

  //get all product
  Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index']);


  //get a product with id
  Route::get('/products/{id}', [\App\Http\Controllers\ProductController::class, 'show']);

  //get category of product
  Route::get('/categoryOfProduct/{id}', [\App\Http\Controllers\ProductController::class, 'ShowCategoryOfProduct']);

  //delete one order by id of user
  Route::delete('/orders/{id}', [\App\Http\Controllers\OrderController::class, 'destroy']);
  //post one order by user id
  Route::post('/orders', [\App\Http\Controllers\OrderController::class, 'store']);
  //get all orders of user
  Route::get('/orders/{id}', [\App\Http\Controllers\OrderController::class, 'index']);

  //get all items of order of user
  Route::get('/orderItems/{id}', [\App\Http\Controllers\OrderItemController::class, 'getAllItemsOfOrder']);
  //post item of order of user
  Route::post('/orderItems', [\App\Http\Controllers\OrderItemController::class, 'store']);
});
