<!-- Venta -->
<div class="mb-4">
    <x-label for="sale_id" value="Venta" />
    <select wire:model="detail_create.sale_id" id="sale_id" class="w-full border-gray-300">
        <option value="" disabled>Seleccione una venta</option>
        @foreach($sales as $sale)
            <option value="{{ $sale->id }}">{{ $sale->id }}</option>
        @endforeach
    </select>
    <x-input-error for="detail_create.sale_id" />
</div>

<!-- Producto -->
<div class="mb-4">
    <x-label for="product_id" value="Producto" />
    <select wire:model="detail_create.product_id" id="product_id" class="w-full border-gray-300">
        <option value="" disabled>Seleccione un producto</option>
        @foreach($products as $product)
            <option value="{{ $product->id }}">{{ $product->nombre }}</option>
        @endforeach
    </select>
    <x-input-error for="detail_create.product_id" />
</div>

<!-- Cantidad -->
<x-input-group label="Cantidad" type="number" model="detail_create.cantidad" />

<!-- Precio Unitario -->
<x-input-group label="Precio Unitario" type="number" model="detail_create.precio_unitario" />

<!-- Importe Total -->
<x-input-group label="Importe Total" type="number" model="detail_create.importe_total" readonly />


{{-- <x-dialog-modal wire:model="isOpen">
    <x-slot name="title">
        <h3>Registrar Detalle de Venta</h3>
    </x-slot>
    <x-slot name="content">

        <!-- Venta -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="sale_id" value="Venta" />
                <select wire:model="detail_create.sale_id" id="sale_id" class="w-full">
                    <option value="0" disabled>Seleccione una venta</option>
                    @foreach($sales as $sale)
                        <option value="{{ $sale->id }}">{{ $sale->id }}</option>
                    @endforeach
                </select>
                <x-input-error for="detail_create.sale_id" />
            </div>
        </div>

        <!-- Producto -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="product_id" value="Producto" />
                <select wire:model="detail_create.product_id" id="product_id" class="w-full">
                    <option value="" disabled>Seleccione un producto</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->nombre }}</option>
                    @endforeach
                </select>
                <x-input-error for="detail_create.product_id" />
            </div>
        </div>

        <!-- Cantidad -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="cantidad" value="Cantidad" />
                <x-input wire:model="detail_create.cantidad" id="cantidad" type="number" min="1" step="1" class="w-full" />
                <x-input-error for="detail_create.cantidad" />
            </div>
        </div>

        <!-- Precio Unitario -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="precio_unitario" value="Precio Unitario" />
                <x-input wire:model="detail_create.precio_unitario" id="precio_unitario" type="number" min="0" step="0.01" class="w-full" />
                <x-input-error for="detail_create.precio_unitario" />
            </div>
        </div>

        <!-- Importe Total -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="importe_total" value="Importe Total" />
                <x-input wire:model="detail_create.importe_total" id="importe_total" type="number" min="0" step="0.01" class="w-full" readonly />
                <x-input-error for="detail_create.importe_total" />
            </div>

            <!-- Botón para calcular el total -->
            <div class="flex items-center justify-center">
                <x-button wire:click="calcularTotal" class="ml-2">
                    Calcular Total
                </x-button>
            </div>
        </div>

    </x-slot>
    <x-slot name="footer">
        <x-secondary-button wire:click="$set('isOpen', false)" class="mx-2">Cancelar</x-secondary-button>
        <x-button wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="store" class="disabled:opacity-25">
            Registrar
        </x-button>
    </x-slot>
</x-dialog-modal> --}}
