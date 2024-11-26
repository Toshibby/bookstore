
<div class="grid grid-cols-10 gap-4 p-6">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Venta <i class="fa fa-shopping-cart text-white"></i>
        </h2>

    </x-slot>

    <div class="col-span-6 space-y-6">
        <section class="p-4 bg-gray-200 rounded-lg shadow-md ">

            <div class="flex justify-between items-start p-6 space-x-4">
                <div class="w-2/3 bg-gray-600 text-gray-100 p-4 rounded-lg shadow-lg overflow-auto">
                    <label for="client_id" class="block text-sm font-medium text-gray-700">Cliente</label>
                    <div class="mb-4 text-blue-300">
                        <p>Cliente seleccionado: <strong>{{ $selected_client_name ?? 'Ninguno' }}</strong></p>
                    </div>

                    <table class="min-w-full divide-y divide-gray-700">
                        <thead>
                            <tr class="bg-gray-500 text-gray-200">
                                <th class="py-2 px-4 text-left">DNI</th>
                                <th class="py-2 px-4 text-left">Nombre</th>
                                <th class="py-2 px-4 text-left">Teléfono</th>
                                <th class="py-2 px-4 text-left">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @foreach($clients as $client)
                                <tr>
                                    <td class="py-2 px-4">{{ $client->dni }}</td>
                                    <td class="py-2 px-4">{{ $client->nombre }}</td>
                                    <td class="py-2 px-4">{{ $client->telefono }}</td>
                                    <td class="py-2 px-4">
                                        <button wire:click="selectClient({{ $client->id }}, '{{ $client->nombre }}')" class="text-blue-200 hover:underline">
                                            Seleccionar <i class="fas fa-user"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="w-1/3">
                    <label for="dni" class="block text-gray-700 font-medium mb-2">Ingrese DNI o RUC:</label>
                    <input type="text" id="dni" placeholder="Buscar cliente" wire:model.live="search_clients" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    <div class="mt-4">
                        <x-button wire:click="createClient()">Registrar nuevo cliente</x-button>
                    </div>
                        @if($isOpenClient)
                            @include('livewire.forms.client.client-create')
                        @endif
                </div>
            </div>
        </section>

        <section class="p-4 bg-gray-50 rounded-lg shadow-md">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Productos</h2>
        <div class="flex items-center space-x-2 mb-4">
            <div class="w-full">
                <input type="text" id="dni" placeholder="Buscar Cproducto" wire:model.live="search_products" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
            </div>
        </div>
        <div class="bg-white shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="w-full divide-y divide-gray-200 table-auto">
                <thead class="bg-gray-700 text-white">
                <tr class="text-left text-xs font-bold  uppercase">
                    <td scope="col" class="px-6 py-3">imagen</td>
                    <td scope="col" class="px-6 py-3">Titulo</td>
                    <td scope="col" class="px-6 py-3">descripcion</td>
                    <td scope="col" class="px-6 py-3">cantida de stock</td>
                    <td scope="col" class="px-6 py-3">precio venta</td>
                    <td scope="col" class="px-6 py-3">cateogia</td>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($products as $product)
                    <tr class="text-sm font-medium text-gray-900">
                        <td class="px-6 py-4">{{$product->imagen}}</td>
                        <td class="px-6 py-4">{{$product->nombre}}</td>
                        <td class="px-6 py-4">{{$product->descripcion}}</td>
                        <td class="px-6 py-4">{{$product->cantidad_stock}}</td>
                        <td class="px-6 py-4 ">{{$product->precio_venta}} S/.</td>
                        <td class="px-6 py-4 flex justify-between items-center">
                        <span>{{$product->category->tipo}}</span>
                        <button wire:click="addToBasket({{ $product->id }})" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600"><i class="fas fa-shopping-cart text-black fa-2x"></i></button>
                    </td>
                    </tr>
                @endforeach
                 </tbody>
            </table>
        </div>
        </section>
    </div>
    <section class="col-span-4 space-y-6 flex flex-col items-center p-4 bg-gray-200 rounded-lg shadow-md h-[100%]">
        <h2 class="text-lg font-bold text-gray-800 mb-4 text-center">Canasta</h2>
    <div class="bg-white shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="w-full divide-y divide-gray-200 table-auto">
            <thead class="bg-gray-700 text-white">
                <tr class="text-left text-xs font-bold uppercase">
                    <td class="px-6 py-3">Producto</td>
                    <td class="px-6 py-3">Cantidad</td>
                    <td class="px-6 py-3">Precio</td>
                    <td class="px-6 py-3">Total</td>
                    <td class="px-6 py-3">Acciones</td>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($baskets as $basket)
                    <tr class="text-sm font-medium text-gray-900">
                        <td class="px-6 py-4">{{ $basket->product->nombre }}</td>
                        <td class="px-6 py-4">
                            <input type="number" min="1" max="{{ $basket['product']['cantidad_stock'] }}" wire:model.lazy="cantidad.{{ $basket['id'] }}" class="w-16 text-center border rounded"/>
                        </td>
                        <td class="px-6 py-4">{{ $basket->product->precio_venta }} S/.</td>
                        <td class="px-6 py-4">{{ $basket['cantidad'] * $basket['product']['precio_venta'] }} S/.</td>
                        <td class="px-6 py-4">
                            <button wire:click="removeFromBasket({{ $basket['id'] }})" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600" >
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>


    <div>
        <div class="mb-4">
            <label for="payment_method_id" class="block text-sm font-medium text-gray-700">Método de Pago</label>
            <ul class="grid w-full gap-6 md:grid-cols-3">
                @foreach($payment_methods as $payment_method)
                    <li>
                        <input type="radio" id="payment-method-{{ $payment_method->id }}" name="payment_method_id" value="{{ $payment_method->id }}" wire:model="payment_method_id" class="hidden peer" {{ $payment_method_id == $payment_method->id ? 'checked' : '' }}>
                        <label for="payment-method-{{ $payment_method->id }}" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer hover:text-gray-600 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 peer-checked:border-blue-600 peer-checked:text-gray-600 hover:bg-gray-50">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">{{ $payment_method->forma }}</div>
                            </div>
                        </label>
                    </li>
                @endforeach
            </ul>
        </div>


        <!-- Totales -->
        <div class="mb-4">
            <div class="flex justify-between">
                <span>Sub Total:</span>
                <span>{{ number_format($sub_total, 2) }} S/.</span> <!-- Sub Total -->
            </div>
            <div class="flex justify-between">
                <span>IGV (18%):</span>
                <span>{{ number_format($igv, 2) }} S/.</span> <!-- IGV -->
            </div>
            <div class="flex justify-between font-bold">
                <span>Total:</span>
                <span>{{ number_format($total, 2) }} S/.</span> <!-- Total -->
            </div>
        </div>

        <!-- Botón para finalizar venta -->
        <div class="mt-4">
            <button wire:click="finalizeSale" class="bg-blue-500 text-white px-4 py-2 rounded">Finalizar Venta</button>
        </div>
        <div class="mt-4">
            <button wire:click="createInvoice" class="btn btn-primary">
                Generar Factura
            </button>
        </div>
        @if (session()->has('error'))
            <div id="error-message" class="text-red-500 font-bold mt-2">
                {{ session('error') }}
            </div>
        @endif

        @if (session()->has('success'))
            <div id="success-message" class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <script>
            setTimeout(() => {
                const successMessage = document.getElementById('success-message');
                if (successMessage) {
                    successMessage.style.display = 'none';
                }
                const errorMessage = document.getElementById('error-message');
                if (errorMessage) {
                    errorMessage.style.display = 'none';
                }
            }, 5000);
        </script>
    </div>
    </section>
</div>


