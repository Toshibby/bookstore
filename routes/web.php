<?php

use App\Livewire\AcquisitionMain;
use App\Livewire\CategoryMain;
use App\Livewire\ClientMain;
use App\Livewire\DashboardMain;
use App\Livewire\DetailMain;
use App\Livewire\OrderDetailMain;
use App\Livewire\OrderMain;
use App\Livewire\OrderStatusMain;
use App\Livewire\PaymentMethodMain;
use App\Livewire\PaymentStatusMain;
use App\Livewire\ProductMain;
use App\Livewire\PurchaseOrderMain;
use App\Livewire\SaleMain;
use App\Livewire\SaleTypeMain;
use App\Livewire\SupplierMain;
use App\Livewire\UserMain;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Cambiar la vista de dashboard por el componente Livewire DashboardMain
    Route::get('/dashboard', DashboardMain::class)->name('dashboard');
});
Route::get("/user",UserMain::class)->name("user");
Route::get("/category",CategoryMain::class)->name("category");
Route::get("/client",ClientMain::class)->name("client");
Route::get("/detail",DetailMain::class)->name("detail");
Route::get("/order",OrderMain::class)->name("order");
Route::get("/payment-method",PaymentMethodMain::class)->name("payment-method");
Route::get("/product",ProductMain::class)->name("product");
Route::get("/sale",SaleMain::class)->name("sale");
Route::get("/sale-type",SaleTypeMain::class)->name("sale-type");
Route::get("/supplier",SupplierMain::class)->name("supplier");
Route::get("/acquisition",AcquisitionMain::class)->name("acquisition");
Route::get("/purchase-order",PurchaseOrderMain::class)->name("purchase-order");
Route::get("/order-detail",OrderDetailMain::class)->name("order-detail");
Route::get("/payment-status",PaymentStatusMain::class)->name("payment-status");
Route::get("/order-status",OrderStatusMain::class)->name("order-status");





