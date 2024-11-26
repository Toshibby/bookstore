<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AcquisitionCreateForm extends Form
{
    #[Rule('required|exists:suppliers,id')]
    public $supplier_id;

    // Fecha de Adquisición: requerido, debe ser una fecha válida
    #[Rule('required|date')]
    public $fecha_adquisicion;

    // Monto Total: requerido, debe ser un número decimal mayor o igual a 0
    #[Rule('required|numeric|min:0')]
    public $monto_total;

    // Estado: requerido, debe ser uno de los valores especificados (pendiente, completado, cancelado)
    #[Rule('required|in:pendiente,completado,cancelado')]
    public $estado;

    // Detalle: opcional, puede ser una cadena de texto
    #[Rule('nullable|string')]
    public $detalle;
}
