<x-dialog-modal wire:model="isOpenEdit">
    <x-slot name="title">
        <h3>Editar Proveedor</h3>
    </x-slot>
    <x-slot name="content">
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="nombre" value="Nombre" />
                <x-input wire:model="supplier_create.nombre" id="nombre" type="text" class="w-full" />
                <x-input-error for="supplier_create.nombre" />
            </div>
        </div>

        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="dni" value="DNI" />
                <x-input wire:model="supplier_create.dni" id="dni" type="text" class="w-full" />
                <x-input-error for="supplier_create.dni" />
            </div>
        </div>

        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="telefono" value="Teléfono" />
                <x-input wire:model="supplier_create.telefono" id="telefono" type="text" class="w-full" />
                <x-input-error for="supplier_create.telefono" />
            </div>
        </div>

        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="email" value="Correo Electrónico" />
                <x-input wire:model="supplier_create.email" id="email" type="email" class="w-full" />
                <x-input-error for="supplier_create.email" />
            </div>
        </div>

        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="direccion" value="Dirección" />
                <textarea wire:model="supplier_create.direccion" id="direccion" class="w-full h-24"></textarea>
                <x-input-error for="supplier_create.direccion" />
            </div>
        </div>

        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="estado" value="Estado" />
                <select wire:model="supplier_create.estado" id="estado" class="w-full">
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
                <x-input-error for="supplier_create.estado" />
            </div>
        </div>
    </x-slot>
    <x-slot name="footer">
        <x-secondary-button wire:click="$set('isOpenEdit',false)" class="mx-2">Cancelar</x-secondary-button>
        <x-button wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="store" class="disabled:opacity-25">
            Editar
        </x-button>
    </x-slot>
</x-dialog-modal>
