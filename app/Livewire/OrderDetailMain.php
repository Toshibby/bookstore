<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\On;
use Livewire\Component;

class OrderDetailMain extends Component
{
    public function render()
    {
        // Obtener las órdenes con los detalles asociados
        $orders = Order::with(['orderDetails.product', 'orderStatus', 'paymentStatus'])->get()->map(function ($order) {
            return [
                'id' => $order->id,
                'fecha_orden' => $order->created_at,
                'productos' => $order->orderDetails->map(function ($orderDetail) {
                    return [
                        'nombre' => $orderDetail->product->nombre,
                        'cantidad' => $orderDetail->cantidad,
                        'total_por_producto' => $orderDetail->importe_total,
                    ];
                }),
                'total_orden' => $order->total,
                'monto_adelanto' => $order->monto_adelanto,
                'order_status' => $order->orderStatus->estado,
                'payment_status' => $order->paymentStatus->estado,
            ];
        });

        // Pasar las órdenes al frontend
        return view('livewire.order-detail-main', compact('orders'));
    }
    #[On('delItem')]
    public function destroy(Order $order){
        //dd($post);
        $order->delete();
    }
}
