<x-dialog-modal wire:model="isOpenEdit">
    <x-slot name="title">
        <h3>Editar Pedido</h3>
    </x-slot>
    <x-slot name="content">

        <!-- Cliente -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="client_id" value="Cliente" />
                <select wire:model="order_create.client_id" id="client_id" class="w-full">
                    <option value="" disabled>Seleccione un cliente</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->nombre }}</option>
                    @endforeach
                </select>
                <x-input-error for="order_create.client_id" />
            </div>
        </div>

        <!-- Producto -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="product_id" value="Producto" />
                <select wire:model="order_create.product_id" id="product_id" class="w-full">
                    <option value="" disabled>Seleccione un producto</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->nombre }}</option>
                    @endforeach
                </select>
                <x-input-error for="order_create.product_id" />
            </div>
        </div>

        <!-- Cantidad -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="cantidad" value="Cantidad" />
                <x-input wire:model="order_create.cantidad" id="cantidad" type="number" min="1" step="1" class="w-full" />
                <x-input-error for="order_create.cantidad" />
            </div>
        </div>

        <!-- Descripción -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="descripcion" value="Descripción" />
                <textarea wire:model="order_create.descripcion" id="descripcion" class="w-full h-24"></textarea>
                <x-input-error for="order_create.descripcion" />
            </div>
        </div>

        <!-- Fecha del Pedido -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="fecha_pedido" value="Fecha del Pedido" />
                <x-input wire:model="order_create.fecha_pedido" id="fecha_pedido" type="datetime-local" class="w-full" />
                <x-input-error for="order_create.fecha_pedido" />
            </div>
        </div>

    </x-slot>
    <x-slot name="footer">
        <x-secondary-button wire:click="$set('isOpenEdit', false)" class="mx-2">Cancelar</x-secondary-button>
        <x-button wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="store" class="disabled:opacity-25">
            Editar
        </x-button>
    </x-slot>
</x-dialog-modal>
