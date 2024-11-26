<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class OrderStatusForm extends Form
{
    #[Rule('required|string')]
    public $estado;

}
