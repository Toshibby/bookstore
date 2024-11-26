<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ClientCreateForm extends Form
{
    #[Rule('required|string|max:255')]
    public $nombre;

    // DNI del cliente, debe ser único en la base de datos
    #[Rule('required|string|unique:clients,dni|max:20')]
    public $dni;

    // Teléfono del cliente, puede ser nulo
    #[Rule('nullable|string|max:15')]
    public $telefono;
    public function rules($clientId = null)
    {
        return [
            'nombre' => 'required|string|max:255',
            'dni' => $clientId ? 'nullable|string|max:20|unique:clients,dni,' . $clientId : 'nullable|string|max:20|unique:clients,dni',
            'telefono' => 'nullable|string|max:15',
        ];
    }
}
