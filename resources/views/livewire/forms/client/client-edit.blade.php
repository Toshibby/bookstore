<x-dialog-modal wire:model="isOpenEdit">
    <x-slot name="title">
        <h3>Editar Cliente</h3>
    </x-slot>
    <x-slot name="content">

        <!-- Nombre -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="nombre" value="Nombre" />
                <x-input wire:model="client_create.nombre" id="nombre" type="text" class="w-full" />
                <x-input-error for="client_create.nombre" />
            </div>
        </div>

        <!-- DNI -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="dni" value="DNI" />
                <x-input wire:model="client_create.dni" id="dni" type="text" class="w-full" />
                <x-input-error for="client_create.dni" />
            </div>
        </div>

        <!-- Teléfono -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="telefono" value="Teléfono" />
                <x-input wire:model="client_create.telefono" id="telefono" type="text" class="w-full" />
                <x-input-error for="client_create.telefono" />
            </div>
        </div>

    </x-slot>
    <x-slot name="footer">
        <x-secondary-button wire:click="$set('isOpenEdit', false)" class="mx-2">Cancelar</x-secondary-button>
        <x-button wire:click.prevent="storeClient()" wire:loading.attr="disabled" wire:target="store" class="disabled:opacity-25">
            Editar
        </x-button>
    </x-slot>
</x-dialog-modal>
