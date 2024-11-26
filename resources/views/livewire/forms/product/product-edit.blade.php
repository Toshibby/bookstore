<x-dialog-modal wire:model="isOpenEdit">
    <x-slot name="title">
        <h3>Editar Producto</h3>
    </x-slot>
    <x-slot name="content">

        <!-- Nombre -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="nombre" value="Nombre del Producto" />
                <x-input wire:model="product_create.nombre" id="nombre" type="text" class="w-full" />
                <x-input-error for="product_create.nombre" />
            </div>
        </div>

        <!-- Imagen -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="imagen" value="Imagen del Producto" />
                <x-input wire:model="product_create.imagen" id="imagen" type="file" class="w-full" />
                <x-input-error for="product_create.imagen" />
            </div>
        </div>

        <!-- Cantidad en Stock -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="cantidad_stock" value="Cantidad en Stock" />
                <x-input wire:model="product_create.cantidad_stock" id="cantidad_stock" type="number" min="0" step="1" class="w-full" />
                <x-input-error for="product_create.cantidad_stock" />
            </div>
        </div>

        <!-- Descripción -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="descripcion" value="Descripción" />
                <textarea wire:model="product_create.descripcion" id="descripcion" class="w-full h-24"></textarea>
                <x-input-error for="product_create.descripcion" />
            </div>
        </div>

        <!-- Categoría -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="category_id" value="Categoría" />
                <select wire:model="product_create.category_id" id="category_id" class="w-full">
                    <option value="" disabled>Seleccione una categoría</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->tipo }}</option>
                    @endforeach
                </select>
                <x-input-error for="product_create.category_id" />
            </div>
        </div>

        <!-- Costo de Compra -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="costo_compra" value="Costo de Compra" />
                <x-input wire:model="product_create.costo_compra" id="costo_compra" type="number" min="0" step="0.01" class="w-full" />
                <x-input-error for="product_create.costo_compra" />
            </div>
        </div>

        <!-- Precio de Venta -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="precio_venta" value="Precio de Venta" />
                <x-input wire:model="product_create.precio_venta" id="precio_venta" type="number" min="0" step="0.01" class="w-full" />
                <x-input-error for="product_create.precio_venta" />
            </div>
        </div>

    </x-slot>
    <x-slot name="footer">
        <x-secondary-button wire:click="$set('isOpenEdit', false)" class="mx-2">Cancelar</x-secondary-button>
        <x-button wire:click.prevent="storeProduct()" wire:loading.attr="disabled" wire:target="store" class="disabled:opacity-25">
            Editar
        </x-button>
    </x-slot>
</x-dialog-modal>
