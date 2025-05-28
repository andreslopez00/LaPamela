<?php
use Laravel\Fortify\Features;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CustomRegisterController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\Admin\ProductController;
use App\Models\Product;

Route::get('/productos-data', function () {
    return response()->json(Product::all());
});



Route::post('/pedido', [PedidoController::class, 'procesar']);

Route::post('/crear-sesion-stripe', [StripeController::class, 'checkout']);



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

Route::get('/user-info', function () {
    return response()->json(Auth::user());
})->middleware('auth');

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/productos/create', [ProductController::class, 'create'])->name('productos.create');
    Route::post('/admin/productos', [ProductController::class, 'store'])->name('productos.store');

    Route::get('/admin/productos/{id}/edit', [ProductController::class, 'edit'])->name('productos.edit');
    Route::put('/admin/productos/{id}', [ProductController::class, 'update'])->name('productos.update');

    Route::get('/admin/productos/{id}/delete', [ProductController::class, 'deleteConfirm'])->name('productos.delete.confirm');
    Route::delete('/admin/productos/{id}', [ProductController::class, 'destroy'])->name('productos.destroy');

        Route::get('/{any}', function () {
        return view('app');
    })->where('any', '.*');
});
