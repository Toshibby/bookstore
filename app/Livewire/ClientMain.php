<?php

namespace App\Livewire;

use App\Livewire\Forms\ClientCreateForm;
use App\Models\Client;
use Livewire\Attributes\On;
use Livewire\Component;

class ClientMain extends Component
{
    public $isOpenClient=false;
    public $client_id;
    public $isOpenEdit=false;
    public ClientCreateForm $client_create;
    public function render()
    {

        $clients=Client::all();
        return view('livewire.client-main',compact("clients"));
    }
    public function createClient(){
        $this->isOpenClient=true;
        $this->client_create->reset();
        $this->resetValidation();
    }
    public function storeClient()
    {
        // Agregar validación para el campo 'dni'
        $this->client_create->validate($this->client_create->rules($this->client_id));



        // Si hay un ID de cliente, actualizamos el cliente
        if ($this->client_id) {
            $client = Client::find($this->client_id);
            $client->update($this->client_create->all());
        } else {
            Client::create($this->client_create->all());
        }

        $this->isOpenClient = false;
        $this->isOpenEdit = false;
        $this->client_id = null;
        $this->dispatch('sweetalert',message:'Registro creado');
    }
    public function edit(Client $client)
    {
        $this->client_id = $client->id;
        $this->client_create->fill($client->toArray());
        $this->isOpenEdit = true;
    }
    #[On('delItem')]
    public function destroy(Client $client){
        //dd($post);
        $client->delete();
    }
}
