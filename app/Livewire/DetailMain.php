<?php

namespace App\Livewire;

use App\Livewire\Forms\DetailCreateForm;
use App\Models\Client;
use App\Models\Detail;
use App\Models\Product;
use App\Models\Sale;
use Livewire\Attributes\On;
use Livewire\Component;


class DetailMain extends Component
{
    public $isOpen = false;
    public $isOpenEdit = false;
    public $detail_id;


    public function render()
    {
        $sales = Sale::with(['details.product'])->get()->map(function ($sale) {
            return [ 'id' => $sale->id, 'fecha_venta' => $sale->fecha_venta, 'productos' => $sale->details->map(function ($detail) {
                    return [ 'nombre' => $detail->product->nombre, 'cantidad' => $detail->cantidad, 'precio_unitario' => $detail->precio_unitario, 'igv' => $detail->importe_total - ($detail->importe_total / 1.18),
                    ];
                }), 'total_productos' => $sale->details->sum('cantidad'), 'total_venta' => $sale->total,
            ];
        });

        return view('livewire.detail-main', compact('sales'));
    }
    #[On('delItem')]
    public function destroy(Sale $sale){
        //dd($post);
        $sale->delete();
    }

}
