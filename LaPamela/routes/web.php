<?php
use Laravel\Fortify\Features;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CustomRegisterController;

Route::get('/register', [CustomRegisterController::class, 'show'])->name('register');
Route::post('/register', [CustomRegisterController::class, 'register']);

Route::middleware('web')->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });

});


Route::get('/', function () {
    return view('app'); // o la vista que muestra tu tienda
})->middleware('auth');


Route::middleware(['auth'])->group(function () {
    Route::get('/{any}', function () {
        return view('app');
    })->where('any', '.*');
});
