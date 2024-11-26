<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DetailCreateForm extends Form
{
    #[Rule('required|exists:sales,id')]
    public $sale_id;

    #[Rule('required|exists:products,id')]
    public $product_id;

    #[Rule('required|integer|min:1')]
    public $cantidad;

    #[Rule('required|numeric|min:0')]
    public $precio_unitario;

    #[Rule('required|numeric|min:0')]
    public $importe_total;
}
