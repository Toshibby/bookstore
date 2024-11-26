<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class OrderCreateForm extends Form
{
    #[Rule('required|exists:clients,id')]
    public $client_id;

    #[Rule('required|exists:order_status,id')]
    public $order_status_id;

    #[Rule('required|exists:payment_status,id')]
    public $payment_status_id;

    #[Rule('required|decimal|min:0')]
    public $total;

    #[Rule('nullable|string')]
    public $descripcion;

    #[Rule('required|exists:payment_methods,id')]
    public $payment_method_id;

    #[Rule('required|integer|min:1')]
    public $cantidad;

    #[Rule('required|exists:products,id')]
    public $product_id;


}
