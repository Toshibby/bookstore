<x-dialog-modal wire:model="isOpen">
    <x-slot name="title">
        <h3>Registrar Tipo de Venta</h3>
    </x-slot>
    <x-slot name="content">

        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="tipo" value="Tipo de Venta" />
                <x-input wire:model="sale_type_create.tipo" id="tipo" type="text" class="w-full" />
                <x-input-error for="sale_type_create.tipo" />
            </div>
        </div>

    </x-slot>
    <x-slot name="footer">
        <x-secondary-button wire:click="$set('isOpen',false)" class="mx-2">Cancelar</x-secondary-button>
        <x-button wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="store" class="disabled:opacity-25">
            Registrar
        </x-button>
    </x-slot>
</x-dialog-modal>
