<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\CustomRegisterController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\Admin\ProductController;
use App\Models\Product;
use App\Models\Order; 
use App\Http\Controllers\ReviewController;

// Devuelve 1 producto por ID
Route::get('/producto-data/{id}', function ($id) {
    return Product::findOrFail($id);
});

// Devuelve todos los productos
Route::get('/productos-data', function () {
    return response()->json(Product::all());
});

// Crear sesión de pago con Stripe
Route::post('/crear-sesion-stripe', [StripeController::class, 'checkout']);

Route::post('/pedido', [PedidoController::class, 'procesar'])->middleware('auth');


// Mis pedidos en formato JSON (para Vue)
Route::get('/mis-pedidos', function () {
    $user = Auth::user();

    return Order::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function ($pedido) {
            return [
                'id' => $pedido->id,
                'created_at' => $pedido->created_at,
                'productos' => json_decode($pedido->productos, true),
                'total' => collect(json_decode($pedido->productos, true))
                    ->sum(fn($item) => $item['precio'] * $item['cantidad']),
            ];
        });
})->middleware('auth');



// Registro personalizado
Route::get('/register', [CustomRegisterController::class, 'show'])->name('register');
Route::post('/register', [CustomRegisterController::class, 'register']);

// Vista login
Route::middleware('web')->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});

// Vista principal Vue
Route::get('/', function () {
    return view('app');
})->middleware('auth');

// Info del usuario logueado
Route::get('/user-info', function () {
    return response()->json(Auth::user());
})->middleware('auth');

// Rutas protegidas (Admin Panel)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/productos/create', [ProductController::class, 'create'])->name('productos.create');
    Route::post('/admin/productos', [ProductController::class, 'store'])->name('productos.store');

    Route::get('/admin/productos/{id}/edit', [ProductController::class, 'edit'])->name('productos.edit');
    Route::put('/admin/productos/{id}', [ProductController::class, 'update'])->name('productos.update');

    Route::get('/admin/productos/{id}/delete', [ProductController::class, 'deleteConfirm'])->name('productos.delete.confirm');
    Route::delete('/admin/productos/{id}', [ProductController::class, 'destroy'])->name('productos.destroy');

    // Catch-all para rutas de Vue
    Route::get('/{any}', function () {
        return view('app');
    })->where('any', '.*');
});
Route::post('/resenas', [ReviewController::class, 'store'])->middleware('auth');
Route::get('/resenas/{id}', [ReviewController::class, 'index']);
