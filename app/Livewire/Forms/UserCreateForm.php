<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserCreateForm extends Form
{
    #[Rule('required')]
    public $name;

    #[Rule('required')]
    public $apellido_paterno;

    public $apellido_materno;

    #[Rule('required')]
    public $password;

    public $dni;

    public $foto_usuario;

    public $direccion;


    #[Rule('required')]
    #[Rule('email')]
    public $email;

}

