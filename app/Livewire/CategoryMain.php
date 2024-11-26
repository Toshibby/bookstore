<?php

namespace App\Livewire;

use App\Livewire\Forms\CategoryCreateForm;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;

class CategoryMain extends Component
{
    public $isOpen = false;
    public $isOpenEdit = false;
    public $category_id;
    public CategoryCreateForm $category_create;
    public function render()
    {
        $categories=Category::all();
        return view('livewire.category-main',compact("categories"));
    }
    public function create(){
        $this->isOpen=true;
        $this->category_create->reset();
        $this->resetValidation();
    }
    public function store(){

        $this->category_create->validate();

        if ($this->category_id) {
            $category = Category::find($this->category_id);
            $category->update($this->category_create->all());
        } else {
            Category::create($this->category_create->all());
        }

        $this->isOpen = false;
        $this->isOpenEdit = false;
        $this->category_id = null;
        $this->dispatch('sweetalert',message:'Registro creado');
    }
    public function edit(Category $category)
    {
        $this->category_id = $category->id;
        $this->category_create->fill($category->toArray());
        $this->isOpenEdit = true;
    }
    #[On('delItem')]
    public function destroy(Category $category){
        //dd($post);
        $category->delete();
    }

}
