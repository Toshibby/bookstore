<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SaleCreateForm extends Form
{
    #[Rule('required|exists:sale_types,id')]
    public $sale_type_id;

    #[Rule('required|exists:clients,id')]
    public $client_id;

    #[Rule('required|numeric|min:0')]
    public $sub_total;

    #[Rule('required|numeric|min:0')]
    public $igv;

    #[Rule('required|numeric|min:0')]
    public $total;

    #[Rule('required|exists:payment_methods,id')]
    public $payment_method_id;

    #[Rule('nullable|date')]
    public $fecha_venta;
}
