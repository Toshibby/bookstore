<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PaymentStatusForm extends Form
{
    #[Rule('required|string')]
    public $estado;

}
