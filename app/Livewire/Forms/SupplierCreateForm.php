<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SupplierCreateForm extends Form
{
    #[Rule('required|string|max:255')]
    public $nombre;

    #[Rule('nullable|string|max:20|unique:suppliers,dni')]
    public $dni;

    #[Rule('nullable|string|max:15')]
    public $telefono;

    #[Rule('nullable|email|max:255')]
    public $email;

    #[Rule('nullable|string')]
    public $direccion;

    #[Rule('required|in:activo,inactivo')]
    public $estado = 'activo';
    public function rules($supplierId = null)
    {
        return [
            'nombre' => 'required|string|max:255',
            'dni' => $supplierId ? 'nullable|string|max:20|unique:suppliers,dni,' . $supplierId : 'nullable|string|max:20|unique:suppliers,dni', // Validación única con excepción
            'telefono' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string',
            'estado' => 'required|in:activo,inactivo',
        ];
    }
}
