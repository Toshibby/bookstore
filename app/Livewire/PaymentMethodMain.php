<?php

namespace App\Livewire;

use App\Livewire\Forms\PaymentMethodCreateForm;
use App\Models\PaymentMethod;
use Livewire\Attributes\On;
use Livewire\Component;

class PaymentMethodMain extends Component
{
    public $isOpen=false;
    public $isOpenEdit=false;
    public $payment_method_id;
    public PaymentMethodCreateForm $payment_method_create;
    public function render()
    {
        $payment_methods=PaymentMethod::all();
        return view('livewire.payment-method-main',compact("payment_methods"));
    }
    public function create(){
        $this->isOpen=true;
        $this->payment_method_create->reset();
        $this->resetValidation();
    }
    public function store(){
        $this->payment_method_create->validate();

        if ($this->payment_method_id) {
            $payment_method = PaymentMethod::find($this->payment_method_id);
            $payment_method->update($this->payment_method_create->all());
        } else {
            PaymentMethod::create($this->payment_method_create->all());
        }

        $this->isOpen = false;
        $this->isOpenEdit = false;
        $this->payment_method_id = null;
        $this->dispatch('sweetalert',message:'Registro creado');
    }
    public function edit(PaymentMethod $payment_method)
    {
        $this->payment_method_id = $payment_method->id;
        $this->payment_method_create->fill($payment_method->toArray());
        $this->isOpenEdit = true;
    }
    #[On('delItem')]
    public function destroy(PaymentMethod $payment_method){
        //dd($post);
        $payment_method->delete();
    }
}
