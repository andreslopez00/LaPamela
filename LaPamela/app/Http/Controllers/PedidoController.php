<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Mail;

class PedidoController extends Controller
{
    public function procesar(Request $request)
    {
        \Log::info('🧾 Pedido recibido', $request->all());
        $datos = $request->validate([
            'nombre' => 'required|string',
            'email' => 'required|email',
            'direccion' => 'required|string',
            'carrito' => 'required|array',
        ]);

        $total = collect($datos['carrito'])->sum(function ($item) {
            return $item['precio'] * $item['cantidad'];
        });

        $pdf = PDF::loadView('factura', [
            'cliente' => $datos,
            'total' => $total,
        ]);

        // Enviar email con PDF adjunto
        \Log::info('📧 Enviando correo a: ' . $datos['email']);

        Mail::send('emails.confirmacion', ['nombre' => $datos['nombre']], function ($message) use ($datos, $pdf) {
            $message->to($datos['email'], $datos['nombre'])
                    ->subject('Factura de tu compra en La Pamela')
                    ->attachData($pdf->output(), 'factura.pdf');
        });

        return response()->json(['status' => 'ok']);
    }
}
