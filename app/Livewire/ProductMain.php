<?php

namespace App\Livewire;

use App\Livewire\Forms\ProductCreateForm;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductMain extends Component
{
    public $isOpenProduct;
    public $isOpenEdit=false;
    public $product_id;
    public ProductCreateForm $product_create;
    public function render()
    {
        $products = Product::with('category')->get();
        $categories=Category::all();
        return view('livewire.product-main',compact("products","categories"));
    }
    public function createProduct(){
        $this->isOpenProduct=true;
        $this->product_create->reset();
        $this->resetValidation();
    }
    public function storeProduct(){


        $this->product_create->validate();

        if ($this->product_id) {
            $product = Product::find($this->product_id);
            $product->update($this->product_create->all());
        } else {
            Product::create($this->product_create->all());
        }

        $this->isOpenProduct = false;
        $this->isOpenEdit = false;
        $this->product_id = null;
        $this->dispatch('sweetalert',message:'Registro creado');
    }
    public function edit(Product $product)
    {
        $this->product_id = $product->id;
        $this->product_create->fill($product->toArray());
        $this->isOpenEdit = true;
    }
    #[On('delItem')]
    public function destroy(Product $product){
        //dd($post);
        $product->delete();
    }
}
