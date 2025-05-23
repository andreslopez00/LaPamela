<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeController extends Controller
{
    public function checkout(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $carrito = $request->input('carrito');

        $lineItems = collect($carrito)->map(function ($item) {
            return [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $item['nombre'],
                    ],
                    'unit_amount' => $item['precio'] * 100,
                ],
                'quantity' => $item['cantidad'],
            ];
        });

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems->toArray(),
            'mode' => 'payment',
            'success_url' => url('/success'),
            'cancel_url' => url('/checkout'),
        ]);

        return response()->json(['id' => $session->id]);
    }
}
