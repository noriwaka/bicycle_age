<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BicycleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PartsController;

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

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['auth']], function () {
        Route::get('/edit', [UserController::class, 'show'])->name('edit');
        //本来はputだが、htmlフォームはput,patchはサポートしていないので@method(put)により指定
        Route::put('/parts/update', [PartsController::class, 'updateAll'])->name('parts.update.all');
        Route::put('/bicycle/info', [BicycleController::class, 'updateInfo'])->name('bicycle.update.info');
        Route::put('/bicycle/add-mileage', [BicycleController::class, 'addmileage'])->name('bicycle.add.mileage');
        Route::post('/parts/add', [PartsController::class, 'addNewParts'])->name('parts.add.new');
    });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
