<div class="py-5">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            tabla de categorias
        </h2>
    </x-slot>
    <div class="max-w-[110rem] mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-between gap-4 mb-2">
            <x-input placeholder="Buscar registro" wire:model.live="search"/>
            <x-button wire:click="create()">Nuevo</x-button>
                @if($isOpen)
                    @include('livewire.forms.category.category-create')
                @endif
        </div>
        <!--Tabla lista de items   -->
        <div class="bg-white shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="w-full divide-y divide-gray-200 table-auto">
              <thead class="bg-gray-800 text-white">
                <tr class="text-left text-xs font-bold  uppercase">
                    <td scope="col" class="px-6 py-3">ID </td>
                    <td scope="col" class="px-6 py-3">tipo </td>
                    <td scope="col" class="px-6 py-3">descripcion</td>
                    <td scope="col" class="px-6 py-3 text-center">Opciones</td>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                @foreach($categories as $category)
                <tr class="text-sm font-medium text-gray-900">
                  <td class="px-6 py-4">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-600 text-white">
                      {{$category->id}}
                    </span>
                  </td>
                  <td class="px-6 py-4">{{$category->tipo}}</td>
                  <td class="px-6 py-4">{{$category->descripcion}}</td>
                  <td class="px-6 py-4 flex gap-1">
                    <button wire:click="edit({{$category}})" class="bg-cyan-800 w-8 h-8 rounded-full text-white text-xl hover:bg-cyan-500"><i class="fa-solid fa-file-pen"></i></button>
                        @if($isOpenEdit)
                            @include('livewire.forms.category.category-edit')
                        @endif
                        <button wire:click="$dispatch('deleteItem',{{$category}})" class="bg-red-800 w-8 h-8 rounded-full text-white text-xl hover:bg-red-500"><i class="fa-solid fa-trash-can"></i></button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
        @if(!$categories->count())
            <p>No existe ningun registro conincidente</p>
        @endif

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
                    Livewire.dispatch('delItem',{category:id});
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
