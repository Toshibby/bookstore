<?php

namespace App\Livewire;

use App\Livewire\Forms\PurchaseOrderCreateForm;
use App\Models\Acquisition;
use App\Models\Product;
use App\Models\PurchaseOrder;
use Livewire\Attributes\On;
use Livewire\Component;

class PurchaseOrderMain extends Component
{
    public $isOpen=false;
    public $cantidad=0;
    public $precio_unitario=0;
    public $total=0;
    public $purchase_order_id;
    public $isOpenEdit = false;

    public PurchaseOrderCreateForm $purchase_order_create;
    public function render()
    {
        $purchase_orders=PurchaseOrder::all();
        $acquisitions=Acquisition::all();
        $products=Product::all();
        return view('livewire.purchase-order-main', compact("purchase_orders","acquisitions","products"));
    }
    public function create(){
        $this->isOpen=true;
        $this->purchase_order_create->reset();
        $this->resetValidation();
    }
    // getTotalProperty es la funcion para total get(nombre de la variable)Property
    public function calcularTotal()
{
    $this->purchase_order_create->total = $this->purchase_order_create->cantidad * $this->purchase_order_create->precio_unitario;
}


    public function store(){

        $this->purchase_order_create->validate();

        if ($this->purchase_order_id) {
            $purchase_order = PurchaseOrder::find($this->purchase_order_id);
            $purchase_order->update($this->purchase_order_create->all());
        } else {
            PurchaseOrder::create($this->purchase_order_create->all());
        }

        $this->isOpen = false;
        $this->isOpenEdit = false;
        $this->purchase_order_id = null;
        $this->dispatch('sweetalert',message:'Registro creado');
    }
    public function edit(PurchaseOrder $purchase_order)
    {
        $this->purchase_order_id = $purchase_order->id;
        $this->purchase_order_create->fill($purchase_order->toArray());
        $this->isOpenEdit = true;
    }
    #[On('delItem')]
    public function destroy(PurchaseOrder $purchase_order){
        //dd($post);
        $purchase_order->delete();
    }

}
