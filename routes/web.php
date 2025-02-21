<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\QRController;
use App\Http\Middleware\CheckTableNumber;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\AllFoodPage;
use App\Livewire\Pages\CartPage;
use App\Livewire\Pages\CheckoutPage;
use App\Livewire\Pages\DetailPage;
use App\Livewire\Pages\FavoritePage;
use App\Livewire\Pages\PromoPage;
use App\Livewire\Pages\HomePage;
use App\Livewire\Pages\PaymentFailurePage;
use App\Livewire\Pages\PaymentSuccessPage;
use App\Livewire\Pages\ScanPage;
use Livewire\Livewire;


Route::middleware(CheckTableNumber::class)->group(function () {
    //  route home beranda
    Route::get('/', HomePage::class)->name('home');
    // route semua makanan
    Route::get('/food', AllFoodPage::class)->name('product.index');
    Route::get('/food/favorite', FavoritePage::class)->name('product.favorite');
    Route::get('/food/promo', PromoPage::class)->name('product.promo');
    Route::get('/food/{id}', DetailPage::class)->name('product.detail');
});


Route::middleware(CheckTableNumber::class)->controller(TransactionController::class)->group(function () {
    Route::get('/cart',  CartPage::class)->name('payment.index');
    Route::get('/checkout',  CheckoutPage::class)->name('payment.checkout');
    // proses pembayaran
    Route::middleware('throttle:10,1')->post('/payment', 'handlePayment')->name('payment');
    Route::get('/payment', function () {
        abort(404);
    });
    // status pembayaran
    Route::get('/payment/status/{id}', 'paymentStatus')->name('payment.status');
    Route::get('payment/success', PaymentSuccessPage::class)->name('payment.success');
    Route::get('payment/failure', PaymentFailurePage::class)->name('payment.failure');
});

// webhook update pembayaran
Route::post('/payment/webhook', [TranscationController::class, 'handleWebhool'])->name('payment.webhook');

Route::controller(QRController::class)->group(function () {
    Route::post('/store-qr-result', 'storeResult')->name('product.scan.store');
    Route::get('/scan', ScanPage::class)->name('product.scan');
    Route::get('/{tableNumber}', 'checkCode')->name('product.scan.table');
});
