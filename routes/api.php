<?php

use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\PlantesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EditRP;
use App\Http\Controllers\ResetPasswordController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/test', function () {
    return 45;
})->middleware(['auth', 'admin']);

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('profile', 'profile');
    Route::put('editProfile', 'editProfile');
});


Route::apiResource('/plante', PlantesController::class)->middleware(['auth']);
// Route::apiResource('/plante', PlantesController::class)->only(['index', 'show'])->middleware(['auth', 'user']);
Route::apiResource('/category', CategoryController::class)->middleware(['auth']);

//Forgot-Reset password 
Route::group(['controller' => ResetPasswordController::class], function () {
    // Request password reset link
    Route::post('forgot-password', 'sendResetLinkEmail')->middleware('guest')->name('password.email');
    // Reset password
    Route::post('reset-password', 'resetPassword')->middleware('guest')->name('password.update');

    Route::get('reset-password/{token}', function (string $token) {
        return $token;
    })->middleware('guest')->name('password.reset');
});
