<?php

use App\Http\Controllers\CatererController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\FeedbackResultController;
use App\Http\Controllers\PasskeyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/passkey/authenticate', [PasskeyController::class, 'authenticateOptions']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::prefix('caterer')->group(function () {
        Route::name('caterer.')->group(function () {
            Route::get('/', [CatererController::class, 'index'])->name('index');
            Route::get('/{caterer}', [CatererController::class, 'show'])->name('show');
            Route::post('/', [CatererController::class, 'store'])->name('store');
            Route::patch('/{caterer}', [CatererController::class, 'update'])->name('update');
            Route::delete('/{caterer}', [CatererController::class, 'destroy'])->name('destroy');
        });
    });

    Route::prefix('dish')->group(function () {
        Route::name('dish.')->group(function () {
            Route::get('/', [DishController::class, 'index'])->name('index');
            Route::get('/{dish}', [DishController::class, 'show'])->name('show');
            Route::post('/{caterer}', [DishController::class, 'store'])->name('store');
            Route::patch('/{dish}', [DishController::class, 'update'])->name('update');
            Route::delete('/{dish}', [DishController::class, 'destroy'])->name('destroy');
        });
    });

    Route::prefix('feedback')->group(function () {
        Route::name('feedback.')->group(function () {
            Route::get('/', [FeedbackResultController::class, 'index'])->name('index');
            Route::get('/{feedbackResult}', [FeedbackResultController::class, 'show'])->name('show');
            Route::post('/{dishChoice}', [FeedbackResultController::class, 'store'])->name('store');
            Route::patch('/{feedbackResult}', [FeedbackResultController::class, 'update'])->name('update');
            Route::delete('/{feedbackResult}', [FeedbackResultController::class, 'destroy'])->name('destroy');
        });
    });

    Route::name('passkey.')->group(function () {
        Route::prefix('passkey')->group(function () {
            Route::get('/register', [PasskeyController::class, 'registerOptions']);
            Route::delete('/delete/{passkey}', [PasskeyController::class, 'destroy'])->name('delete');
            Route::post('/store', [PasskeyController::class, 'store'])->name('store');
        });
    });
});
