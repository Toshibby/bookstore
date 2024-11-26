<div>
    <div class="py-5">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                Tabla ventas
            </h2>
        </x-slot>
        <div class="max-w-[110rem] mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="w-full divide-y divide-gray-200 table-auto">
                    <thead class="bg-gray-900 text-white">
                        <tr class="text-left text-xs font-bold uppercase">
                            <td scope="col" class="px-6 py-3">N° Venta</td>
                            <td scope="col" class="px-6 py-3">Productos</td>
                            <td scope="col" class="px-6 py-3">Cantidad</td>
                            <td scope="col" class="px-6 py-3">Precio Unitario</td>
                            <td scope="col" class="px-6 py-3">IGV</td>
                            <td scope="col" class="px-6 py-3">Total de Venta</td>
                            <td scope="col" class="px-6 py-3">Fecha Venta</td>
                            <td scope="col" class="px-6 py-3 text-center">Opciones</td>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($sales as $sale)
                            <tr class="text-sm font-medium text-gray-900">
                                <td class="px-6 py-4">{{ $sale['id'] }}</td>
                                <td class="px-6 py-4">
                                    <ul>
                                        @foreach($sale['productos'] as $producto)
                                            <li>
                                                {{ $producto['nombre'] }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-6 py-4">
                                    <ul>
                                        @foreach($sale['productos'] as $producto)
                                            <li>
                                                {{ $producto['cantidad'] }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-6 py-4">
                                    <ul>
                                        @foreach($sale['productos'] as $producto)
                                            <li>
                                                {{ number_format($producto['precio_unitario'], 2) }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-6 py-4">
                                    <ul>
                                        @foreach($sale['productos'] as $producto)
                                            <li>
                                                {{ number_format($producto['igv'], 2) }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-6 py-4">
                                    {{ number_format($sale['total_venta'], 2) }}
                                </td>
                                <td class="px-6 py-4">{{ $sale['fecha_venta'] }}</td>
                                <td class="px-6 py-4 flex gap-1">
                                    <button wire:click="$dispatch('deleteItem',{{$sale["id"]}})" class="bg-red-800 w-8 h-8 rounded-full text-white text-xl hover:bg-red-500"><i class="fa-solid fa-trash-can"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if(!$sales->count())
                <p>No existe ningún registro coincidente</p>
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
                    Livewire.dispatch('delItem',{sale:id});
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
