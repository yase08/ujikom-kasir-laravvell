<?php

use App\Http\Controllers\DetailSaleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
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

// PUBLIC ROUTE
Route::get('/', function () {
    return view('pages.index');
});

// PROTECTED ROUTE BY LOGIN
Route::middleware("isLogin")->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name("dashboard");

    // PROTECTED ROUTE BY ADMIN
    Route::middleware("isAdmin")->group(function () {
        // GET ROUTE
        Route::get("/dashboard/user", [UserController::class, "index"])->name("user");
        Route::get("/dashboard/user/create", [UserController::class, "create"])->name("user.create");
        Route::get("/dashboard/user/edit/{id}", [UserController::class, "edit"])->name("user.edit");

        Route::get("/dashboard/product", [ProductController::class, "index"])->name("product");
        Route::get("/dashboard/product/create", [ProductController::class, "create"])->name("product.create");
        Route::get("/dashboard/product/edit/{id}", [ProductController::class, "edit"])->name("product.edit");

        Route::get("/dashboard/sale", [SaleController::class, "index"])->name("sale");

        Route::get("/dashboard/detail-sale", [SaleController::class, "detail"])->name("detail_sale");

        Route::get("/dashboard/register", [UserController::class, "register"])->name("register");

        //POST ROUTE
        Route::post("/user/store", [UserController::class, "store"])->name("user.store");
        Route::post("/product/store", [ProductController::class, "store"])->name("product.store");
        Route::post("/sale/store", [SaleController::class, "store"])->name("sale.store");
        Route::post("/user/register", [UserController::class, "registerStore"])->name("user.register");

        // PATCH ROUTE
        Route::patch("/user/update/{id}", [UserController::class, "update"])->name("user.update");
        Route::patch("/product/update/{id}", [ProductController::class, "update"])->name("product.update");

        //DELETE ROUTE
        Route::delete("/user/delete/{id}", [UserController::class, "destroy"])->name("user.delete");
        Route::delete("/product/delete/{id}", [ProductController::class, "destroy"])->name("product.delete");
        Route::delete("/detailSale/delete/{id}", [SaleController::class, "destroy"])->name("detail_sale.delete");
    });

    // PROTECTED ROUTE BY ADMIN & User
    Route::middleware("auth")->group(function () {
        Route::get("/dashboard/product", [ProductController::class, "index"])->name("product");
        Route::get("/dashboard/product/create", [ProductController::class, "create"])->name("product.create");
        Route::get("/dashboard/product/edit/{id}", [ProductController::class, "edit"])->name("product.edit");

        Route::get("/dashboard/sale", [SaleController::class, "index"])->name("sale");

        //POST ROUTE
        Route::post("/product/store", [ProductController::class, "store"])->name("product.store");
        Route::post("/sale/store", [SaleController::class, "store"])->name("sale.store");

        // PATCH ROUTE
        Route::patch("/product/update/{id}", [ProductController::class, "update"])->name("product.update");

        //DELETE ROUTE
        Route::delete("/product/delete/{id}", [ProductController::class, "destroy"])->name("product.delete");
    });
});

require __DIR__ . '/auth.php';
