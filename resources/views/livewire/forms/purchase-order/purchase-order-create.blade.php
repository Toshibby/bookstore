<x-dialog-modal wire:model="isOpen">
    <x-slot name="title">
        <h3>Registrar Orden de Compra</h3>
    </x-slot>
    <x-slot name="content">

        <!-- Selección de adquisición -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="acquisition_id" value="Adquisición" />
                <select wire:model="purchase_order_create.acquisition_id" id="acquisition_id" class="w-full">
                    <option value="" disabled>Seleccione una adquisición</option>
                    @foreach($acquisitions as $acquisition)
                        <option value="{{ $acquisition->id }}">{{ $acquisition->detalle }}</option>
                    @endforeach
                </select>
                <x-input-error for="purchase_order_create.acquisition_id" />
            </div>
        </div>

        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="product_id" value="Producto" />
                <select wire:model="purchase_order_create.product_id" id="product_id" class="w-full">
                    <option value="" disabled>Seleccione un producto</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->nombre }}</option>
                    @endforeach
                </select>
                <x-input-error for="purchase_order_create.product_id" />
            </div>
        </div>

        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="cantidad" value="Cantidad" />
                <x-input wire:model="purchase_order_create.cantidad" id="cantidad" type="number" step="1" min="1" class="w-full" />
                <x-input-error for="purchase_order_create.cantidad" />
            </div>
        </div>

        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="precio_unitario" value="Precio Unitario" />
                <x-input wire:model="purchase_order_create.precio_unitario" id="precio_unitario" type="number" step="0.01" class="w-full" />
                <x-input-error for="purchase_order_create.precio_unitario" />
            </div>
        </div>

        <!-- Total -->

        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="total" value="Total" />
                <x-input wire:model="purchase_order_create.total" id="total" type="number" step="0.01" class="w-full" disabled />
                {{-- <x-input id="total" type="number" step="0.01" class="w-full" value="{{ $this->total }}" disabled /> --}}
            </div>
        </div>

        <div class="flex justify-end mx-2 mb-6">
            <x-button wire:click="calcularTotal()" class="mx-2">
                Calcular Total
            </x-button>
        </div>

        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="fecha_orden" value="Fecha de Orden" />
                <x-input wire:model="purchase_order_create.fecha_orden" id="fecha_orden" type="date" class="w-full" />
                <x-input-error for="purchase_order_create.fecha_orden" />
            </div>
        </div>

    </x-slot>
    <x-slot name="footer">
        <x-secondary-button wire:click="$set('isOpen', false)" class="mx-2">Cancelar</x-secondary-button>
        <x-button wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="store" class="disabled:opacity-25">
            Registrar
        </x-button>
    </x-slot>
</x-dialog-modal>
