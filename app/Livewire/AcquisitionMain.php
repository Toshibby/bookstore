<?php

namespace App\Livewire;

use App\Livewire\Forms\AcquisitionCreateForm;
use App\Models\Acquisition;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class AcquisitionMain extends Component
{
    public $isOpen=false;
    public $isOpenEdit=false;
    public $acquisition_id;
    public AcquisitionCreateForm $acquisition_create;
    public function render()
    {
        $acquisitions=Acquisition::all();
        $suppliers=Supplier::all();

        return view('livewire.acquisition-main',compact("acquisitions","suppliers"));
    }
    public function create(){
        $this->isOpen=true;
        $this->acquisition_create->reset();
        $this->resetValidation();
    }
    public function store(){
        // $user = Auth::user(); // para verifiicarsi usuario está autenticado
        // dd($user);


        $this->acquisition_create->validate();

        if ($this->acquisition_id) {
            $acquisition = Acquisition::find($this->acquisition_id);
            $acquisition->update(array_merge(
                $this->acquisition_create->all(),
                ['user_id' => Auth::id()]));
            // $acquisition->update($this->acquisition_create->all());
        } else {
            Acquisition::create([
                'supplier_id' => $this->acquisition_create->supplier_id,
                'fecha_adquisicion' => $this->acquisition_create->fecha_adquisicion,
                'monto_total' => $this->acquisition_create->monto_total,
                'estado' => $this->acquisition_create->estado,
                'detalle' => $this->acquisition_create->detalle,
                'user_id' => Auth::id(),
            ]);
        }

        $this->isOpen = false;
        $this->isOpenEdit = false;
        $this->acquisition_id = null;
        $this->dispatch('sweetalert',message:'Registro creado');

    }
    public function edit(Acquisition $acquisition)
    {
        $this->acquisition_id = $acquisition->id;
        $this->acquisition_create->fill($acquisition->toArray());
        $this->isOpenEdit = true;
    }
    #[On('delItem')]
    public function destroy(Acquisition $acquisition){
        //dd($post);
        $acquisition->delete();
    }
}
