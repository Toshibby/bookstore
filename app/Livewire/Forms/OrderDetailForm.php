<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class OrderDetailForm extends Form
{
    #[Rule('required|exists:orders,id')]
    public $order_id;

    #[Rule('required|exists:products,id')]
    public $product_id;

    #[Rule('required|integer|min:1')]
    public $cantidad;
    #[Rule('required|integer|min:1')]
    public $monto_adelanto;

    #[Rule('required|numeric|min:0')]
    public $precio_unitario;

    #[Rule('required|numeric|min:0')]
    public $total;
}
