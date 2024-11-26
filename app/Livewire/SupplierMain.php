<?php

namespace App\Livewire;

use App\Livewire\Forms\SupplierCreateForm;
use App\Models\Supplier;
use Livewire\Attributes\On;
use Livewire\Component;

class SupplierMain extends Component
{
    public SupplierCreateForm $supplier_create;
    public $isOpenEdit = false;
    public $isOpen=false;
    public $search;
    public $supplier_id;
    public function render()
    {
        $suppliers=Supplier::where('nombre','LIKE','%'.$this->search.'%')->latest('id')->paginate();
        return view('livewire.supplier-main',compact("suppliers"));
    }

    public function create(){
        $this->isOpen=true;
        $this->supplier_create->reset();
        $this->resetValidation();
    }
    public function store(){


        $this->supplier_create->validate($this->supplier_create->rules($this->supplier_id));

        if ($this->supplier_id) {
            $supplier = Supplier::find($this->supplier_id);
            $supplier->update($this->supplier_create->all());
        } else {
            Supplier::create($this->supplier_create->all());
        }

        $this->isOpen = false;
        $this->isOpenEdit = false;
        $this->supplier_id = null;
        $this->dispatch('sweetalert',message:'Registro creado');

    }
    public function edit(Supplier $supplier)
    {
        $this->supplier_id = $supplier->id;
        $this->supplier_create->fill($supplier);
        // $this->supplier_create->fill($supplier->toArray()); asi era antes

        $this->isOpenEdit = true;
    }

    #[On('delItem')]
    public function destroy(Supplier $supplier){
        //dd($post);
        $supplier->delete();
    }

}
