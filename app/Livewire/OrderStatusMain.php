<?php

namespace App\Livewire;

use App\Livewire\Forms\OrderStatusForm;
use App\Models\OrderStatus;
use Livewire\Attributes\On;
use Livewire\Component;

class OrderStatusMain extends Component
{
    public $isOpen;
    public $isOpenEdit;
    public $order_status_id;
    public OrderStatusForm $order_status_form;
    public function render()
    {
        $order_statuses=OrderStatus::all();
        return view('livewire.order-status-main', compact("order_statuses"));
    }
    public function create(){
        $this->isOpen=true;
        $this->order_status_form->reset();
        $this->resetValidation();
    }
    public function store(){


        $this->order_status_form->validate();

        if ($this->order_status_id) {
            $order_status = OrderStatus::find($this->order_status_id);
            $order_status->update($this->order_status_form->all());
        } else {
            OrderStatus::create($this->order_status_form->all());
        }

        $this->isOpen = false;
        $this->isOpenEdit = false;
        $this->order_status_id = null;
        $this->dispatch('sweetalert',message:'Registro creado');
    }
    public function edit(OrderStatus $order_status)
    {
        $this->order_status_id = $order_status->id;
        $this->order_status_form->fill($order_status->toArray());
        $this->isOpenEdit = true;
    }
    #[On('delItem')]
    public function destroy(OrderStatus $order_status){
        //dd($post);
        $order_status->delete();
    }
}
