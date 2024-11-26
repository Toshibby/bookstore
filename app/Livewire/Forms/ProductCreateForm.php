<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductCreateForm extends Form
{
    #[Rule  ('nullable|string|max:255')]
    public $nombre;

    #[Rule('nullable|string|max:255')]
    public $imagen;

    #[Rule('required|integer|min:0')]
    public $cantidad_stock;

    #[Rule('nullable|string')]
    public $descripcion;

    #[Rule('required|exists:categories,id')]
    public $category_id;

    #[Rule('required|numeric|min:0')]
    public $costo_compra;

    #[Rule('required|numeric|min:0')]
    public $precio_venta;
}
