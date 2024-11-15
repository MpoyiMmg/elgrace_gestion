<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PreInvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('login');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(DashboardController::class)->group(function() {
        Route::get('/dashboard', 'index')->name("dashboard");
    });

    Route::controller(ArticleController::class)->group(function () {
        Route::get('/articles', 'index')->name('articles.index');
        Route::get('/articles/create', 'create')->name('articles.create');
        Route::post('/articles/store', 'store')->name('articles.store');
        // Route::get('/{article}', [ArticleController::class, 'show'])->name('articles.show');
        // Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
        // Route::patch('/{article}', [ArticleController::class, 'update'])->name('articles.update');
        // Route::delete('/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    });

    Route::controller(ServiceController::class)->group(function() {
        Route::get('/services', 'index')->name("services.index");
        Route::get('/services/create', [ServiceController::class, 'create'])->name("services.create");
        Route::post('/services/store', [ServiceController::class,'store'])->name("services.store");
        // Route::get('/{service}', [ServiceController::class,'show'])->name("services.show");
        // Route::get('/{service}/edit', [ServiceController::class, 'edit'])->name("services.edit");
        // Route::patch('/{service}', [ServiceController::class, 'update'])->name("services.update");
        // Route::delete('/{service}', [ServiceController::class, 'destroy'])->name("services.destroy");
    });

    Route::controller(ClientController::class)->group(function () {
        Route::get('/clients', 'index')->name('clients.index');
        Route::get('/clients/create', 'create')->name('clients.create');
        Route::post('/clients/store', 'store')->name('clients.store');
    });

    Route::controller(PreInvoiceController::class)->group(function() {
        Route::get('/services-invoices', 'index')->name('services.invoices.index');
        Route::get('/services-invoices/create', 'create')->name('services.invoices.create');
        Route::post('/services-invoices/add-item', 'addServiceItem')->name('services.invoices.add.item');
        Route::post('/services-invoices/remove-item', 'removeItem')->name('services.invoices.remove.item');
        Route::get('/services-invoices/get-items', 'getItems')->name('services.invoices.get.items');
        Route::post('/services-invoices/store', 'store')->name('services.invoices.store');
        Route::get('/services-invoices/{invoice}', 'show')->name('services.invoices.show');
        Route::get('/services-invoices/{invoice}/edit', 'edit')->name('services.invoices.edit');
        Route::post('services-invoices/{invoice}/update', 'update')->name('services.invoices.update');

        Route::get('/articles-invoices', 'listArticleInvoices')->name('articles.invoices.index');
        Route::get('/articles-invoices/create', 'createArticleInvoice')->name('articles.invoices.create');
        Route::post('/articles-invoices/add-item', 'addArticleItem')->name('articles.invoices.add.item');
        Route::post('/articles-invoices/remove-item', 'removeArticleItem')->name('articles.invoices.remove.item');
        Route::get('/articles-invoices/get-items', 'getArticleItems')->name('articles.invoices.get.items');
        Route::post('/articles-invoices/store', 'storeArticleInvoice')->name('articles.invoices.store');
        Route::get('/articles-invoices/{invoice}', 'showArticleInvoice')->name('articles.invoices.show');
        Route::get('/articles-invoices/{invoice}/print', 'printArticleInvoice')->name('articles.invoices.print');
        Route::get('/articles-invoices/{invoice}/edit', 'editArticleInvoice')->name('articles.invoices.edit');
        Route::post('articles-invoices/{invoice}/update', 'updateArticleInvoice')->name('articles.invoices.update');

        Route::post('articles-invoices/{invoice}/validate', 'validateArticleInvoice')->name('articles.invoices.validate');
        Route::post('articles-invoices/{invoice}/reject', 'rejectArticleInvoice')->name('articles.invoices.reject');
        Route::post('/articles-invoices/{invoice}/send-for-validation', 'sendForValidation')->name('articles.invoices.sendForValidation');
        Route::post('/articles-invoices/{invoice}/to-invoice', 'articleProformatToInvoice')->name('articles.invoices.toInvoice');
    });

    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/final-invoices', 'index')->name('final-invoices.index');
        Route::get('/final-invoices/{invoice}', 'details')->name('final-invoices.details');
        Route::get('/final-invoices/{invoice}/print', 'printInvoice')->name('final-invoices.print');
        Route::post('/final-invoices/{invoice}/add-payment', 'makePayment')->name('final-invoices.add-payment');
    });
});



require __DIR__.'/auth.php';
