<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CategoryCreateForm extends Form
{
    #[Rule('required|string|max:255')]
    public $tipo;

    // Descripción de la categoría, opcional y de tipo texto
    #[Rule('nullable|string')]
    public $descripcion;
}
