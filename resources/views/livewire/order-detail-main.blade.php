<div>
    <div class="py-5">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                Tabla de Órdenes
            </h2>
        </x-slot>
        <div class="max-w-[110rem] mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="w-full divide-y divide-gray-200 table-auto">
                    <thead class="bg-gray-900 text-white">
                        <tr class="text-left text-xs font-bold uppercase">
                            <td scope="col" class="px-6 py-3">N° Orden</td>
                            <td scope="col" class="px-6 py-3">Productos</td>
                            <td scope="col" class="px-6 py-3">Cantidad</td>
                            <td scope="col" class="px-6 py-3">Total por Producto</td>
                            <td scope="col" class="px-6 py-3">Monto Adelanto</td>
                            <td scope="col" class="px-6 py-3">Estado de la Orden</td>
                            <td scope="col" class="px-6 py-3">Estado de Pago</td>
                            <td scope="col" class="px-6 py-3">Total de Orden</td>
                            <td scope="col" class="px-6 py-3">Fecha de Orden</td>
                            <td scope="col" class="px-6 py-3 text-center">Opciones</td>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($orders as $order)
                            <tr class="text-sm font-medium text-gray-900">
                                <td class="px-6 py-4">{{ $order['id'] }}</td>
                                <td class="px-6 py-4">
                                    <ul>
                                        @foreach($order['productos'] as $producto)
                                            <li>
                                                {{ $producto['nombre'] }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-6 py-4">
                                    <ul>
                                        @foreach($order['productos'] as $producto)
                                            <li>
                                                {{ $producto['cantidad'] }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-6 py-4">
                                    <ul>
                                        @foreach($order['productos'] as $producto)
                                            <li>
                                                {{ number_format($producto['total_por_producto'], 2) }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-6 py-4">
                                    {{ number_format($order['monto_adelanto'], 2) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $order['order_status'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $order['payment_status'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ number_format($order['total_orden'], 2) }}
                                </td>
                                <td class="px-6 py-4">{{ $order['fecha_orden'] }}</td>
                                <td class="px-6 py-4 flex gap-1">
                                    <button wire:click="$dispatch('deleteItem',{{$order["id"]}})" class="bg-red-800 w-8 h-8 rounded-full text-white text-xl hover:bg-red-500"><i class="fa-solid fa-trash-can"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if(!$orders->count())
                <p>No existen registros de órdenes</p>
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
                    Livewire.dispatch('delItem',{order:id});
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
