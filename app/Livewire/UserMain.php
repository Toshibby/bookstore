<?php
namespace App\Livewire;

use App\Livewire\Forms\UserCreateForm;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class UserMain extends Component
{
    public $isOpen = false;
    public $search;
    public $isOpenEdit = false;
    public UserCreateForm $user_create;
    public $user_id; // Agregar ID del usuario a editar

    public function render()
    {
        $users=User::where('name','LIKE','%'.$this->search.'%')->latest('id')->paginate();
        return view('livewire.user-main', compact("users"));
    }

    public function create()
    {
        $this->isOpen = true;
        $this->user_create->reset();
        $this->resetValidation();
    }

    public function store()
    {
        $this->user_create->validate();


        if ($this->user_id) {
            $user = User::find($this->user_id);
            $user->update($this->user_create->all());
        } else {
            User::create($this->user_create->all());
        }

        $this->isOpen = false;
        $this->isOpenEdit = false;
        $this->user_id = null;
        $this->dispatch('sweetalert',message:'Registro creado');
    }

    public function edit(User $user)
    {
        $this->user_id = $user->id;
        $this->user_create->fill($user->toArray());
        $this->isOpenEdit = true;
    }
    #[On('delItem')]
    public function destroy(User $user){
        //dd($post);
        $user->delete();
    }
}
