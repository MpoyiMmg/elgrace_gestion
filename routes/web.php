<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
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
        Route::post('/services-invoices/add-item', 'addItem')->name('services.invoices.add.item');
        Route::post('/services-invoices/remove-item', 'removeItem')->name('services.invoices.remove.item');
        Route::get('/services-invoices/get-items', 'getItems')->name('services.invoices.get.items');
        Route::post('/services-invoices/store', 'store')->name('services.invoices.store');
        Route::get('/services-invoices/{invoice}', 'show')->name('services.invoices.show');
        Route::get('/services-invoices/{invoice}/edit', 'edit')->name('services.invoices.edit');
        Route::post('services-invoices/{invoice}/update', 'update')->name('services.invoices.update');
    });
});



require __DIR__.'/auth.php';
