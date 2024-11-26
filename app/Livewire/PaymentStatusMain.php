<?php

namespace App\Livewire;

use App\Livewire\Forms\PaymentStatusForm;
use App\Models\PaymentStatus;
use Livewire\Attributes\On;
use Livewire\Component;

class PaymentStatusMain extends Component
{
    public $isOpen;
    public $isOpenEdit;
    public $payment_status_id;
    public PaymentStatusForm $payment_status_form;
    public function render()
    {
        $payment_statuses=PaymentStatus::all();
        return view('livewire.payment-status-main', compact("payment_statuses"));
    }
    public function create(){
        $this->isOpen=true;
        $this->payment_status_form->reset();
        $this->resetValidation();
    }
    public function store(){


        $this->payment_status_form->validate();

        if ($this->payment_status_id) {
            $payment_status = PaymentStatus::find($this->payment_status_id);
            $payment_status->update($this->payment_status_form->all());
        } else {
            PaymentStatus::create($this->payment_status_form->all());
        }

        $this->isOpen = false;
        $this->isOpenEdit = false;
        $this->payment_status_id = null;
        $this->dispatch('sweetalert',message:'Registro creado');
    }
    public function edit(PaymentStatus $payment_status)
    {
        $this->payment_status_id = $payment_status->id;
        $this->payment_status_form->fill($payment_status->toArray());
        $this->isOpenEdit = true;
    }
    #[On('delItem')]
    public function destroy(PaymentStatus $payment_status){
        //dd($post);
        $payment_status->delete();
    }
}
