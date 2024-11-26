<div class="py-5">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            tabla proveedor
        </h2>
    </x-slot>
    <div class="max-w-[110rem] mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-between gap-4 mb-2">
            <x-input placeholder="Buscar registro" wire:model.live="search"/>
            <x-button wire:click="create()">Nuevo</x-button>
                @if($isOpen)
                    @include('livewire.forms.supplier.supplier-create')
                @endif
        </div>
        <!--Tabla lista de items   -->
        <div class="bg-white shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="w-full divide-y divide-gray-200 table-auto">
              <thead class="bg-gray-800 text-white">
                <tr class="text-left text-xs font-bold  uppercase">
                  <td scope="col" class="px-6 py-3">ID</td>
                  <td scope="col" class="px-6 py-3">Nombre</td>
                  <td scope="col" class="px-6 py-3">DNI</td>
                  <td scope="col" class="px-6 py-3">Telefono</td>
                  <td scope="col" class="px-6 py-3">Email</td>
                  <td scope="col" class="px-6 py-3">Direccion</td>
                  <td scope="col" class="px-6 py-3">Estado</td>
                  <td scope="col" class="px-6 py-3 text-center">Opciones</td>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                @foreach($suppliers as $supplier)
                <tr class="text-sm font-medium text-gray-900">
                  <td class="px-6 py-4">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-600 text-white">
                      {{$supplier->id}}
                    </span>
                  </td>
                  <td class="px-6 py-4">{{$supplier->nombre}}</td>
                  <td class="px-6 py-4">{{$supplier->dni}}</td>
                  <td class="px-6 py-4">{{$supplier->telefono}}</td>
                  <td class="px-6 py-4">{{$supplier->email}}</td>
                  <td class="px-6 py-4">{{$supplier->direccion}}</td>
                  <td class="px-6 py-4">{{$supplier->estado}}</td>
                  <td class="px-6 py-4 flex gap-1">
                    <button>edit</button>
                    <button wire:click="edit({{$supplier}})" class="bg-cyan-800 w-8 h-8 rounded-full text-white text-xl hover:bg-cyan-500"><i class="fa-solid fa-file-pen"></i></button>
                            @if($isOpenEdit)
                                @include('livewire.forms.supplier.supplier-edit')
                            @endif
                    <button wire:click="$dispatch('deleteItem',{{$supplier}})" class="bg-red-800 w-8 h-8 rounded-full text-white text-xl hover:bg-red-500"><i class="fa-solid fa-trash-can"></i></button>

                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
        @if(!$suppliers->count())
            <p>No existe ningun registro conincidente</p>
        @endif
        {{-- @if($posts->hasPages())
        <div class="px-6 py-3">
            {{$posts->links()}}
        </div>
        @endif --}}

        </div>
      </div>
      @push('js')
        <script>
            Livewire.on('deleteItem', (id) => {
                Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                if (result.isConfirmed) {
                    //alert(id);
                    Livewire.dispatch('delItem',{supplier:id});
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                }
                })
            });
        </script>
      @endpush
</div>
