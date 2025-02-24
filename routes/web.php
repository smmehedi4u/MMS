<?php

use App\Models\Deposit;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ProfileController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    });
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Task Management Routes
    Route::prefix('admin/tasks')->group(function () {
        Route::post('/store', [TaskController::class, 'store'])->name('task.store');
        Route::get('/getall', [TaskController::class, 'getall'])->name('task.getall');
        Route::get('/{id}/edit', [TaskController::class, 'edit'])->name('task.edit');
        Route::post('/update', [TaskController::class, 'update'])->name('task.update');
        Route::delete('/delete', [TaskController::class, 'delete'])->name('task.delete');
    });

    //Deposit crud route
    Route::prefix('admin/deposit')->group(function () {
        Route::post('/store', [DepositController::class, 'store'])->name('deposit.store');
        Route::get('/getall', [DepositController::class, 'getall'])->name('deposit.getall');
        Route::get('/{id}/edit', [DepositController::class, 'edit'])->name('deposit.edit');
        Route::post('/update', [DepositController::class, 'update'])->name('deposit.update');
        Route::delete('/delete', [DepositController::class, 'delete'])->name('deposit.delete');
    });


});

Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
