<?php

namespace App\Livewire;

use App\Livewire\Forms\SaleTypeCreateForm;
use App\Models\SaleType;
use Livewire\Attributes\On;
use Livewire\Component;

class SaleTypeMain extends Component
{
    public $isOpen=false;
    public $isOpenEdit=false;
    public SaleTypeCreateForm $sale_type_create;
    public $sale_type_id;

    public function render()
    {
        $sale_types=SaleType::all();
        return view('livewire.sale-type-main',compact("sale_types"));
    }
    public function create(){
        $this->isOpen=true;
        $this->sale_type_create->reset();
        $this->resetValidation();
    }
    public function store(){
        $this->sale_type_create->validate();

        if ($this->sale_type_id) {
            $sale_type = SaleType::find($this->sale_type_id);
            $sale_type->update($this->sale_type_create->all());
        } else {
            SaleType::create($this->sale_type_create->all());
        }

        $this->isOpen = false;
        $this->isOpenEdit = false;
        $this->sale_type_id = null;
        $this->dispatch('sweetalert',message:'Registro creado');
    }
    public function edit(SaleType $sale_type)
    {
        $this->sale_type_id = $sale_type->id;
        $this->sale_type_create->fill($sale_type->toArray());
        $this->isOpenEdit = true;
    }
    #[On('delItem')]
    public function destroy(SaleType $sale_type){
        //dd($post);
        $sale_type->delete();
    }
}
