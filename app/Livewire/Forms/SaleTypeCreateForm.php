<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SaleTypeCreateForm extends Form
{
    #[Rule('required|string|max:255')]
    public $tipo;
}
