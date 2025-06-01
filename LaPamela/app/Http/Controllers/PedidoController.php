<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use PDF;

class PedidoController extends Controller
{
    public function procesar(Request $request)
    {
        \Log::info('🧾 Pedido recibido', $request->all());

        // Validación de datos
        $datos = $request->validate([
            'nombre' => 'required|string',
            'email' => 'required|email',
            'direccion' => 'required|string',
            'carrito' => 'required|array',
            'total' => 'required|numeric',
        ]);

        // Guardar pedido en la base de datos
        Order::create([
            'user_id' => Auth::id(),
            'productos' => json_encode($datos['carrito']),
            'total' => $datos['total'],
            'estado' => 'Procesando',
        ]);

        // Generar PDF de la factura
        $pdf = PDF::loadView('factura', [
            'cliente' => $datos,
            'total' => $datos['total'],
        ]);

        // Enviar correo con factura adjunta
        \Log::info('📧 Enviando correo a: ' . $datos['email']);

        Mail::send('emails.confirmacion', ['nombre' => $datos['nombre']], function ($message) use ($datos, $pdf) {
            $message->to($datos['email'], $datos['nombre'])
                    ->subject('Factura de tu compra en La Pamela')
                    ->attachData($pdf->output(), 'factura.pdf');
        });

        return response()->json(['status' => 'ok']);
    }
}
