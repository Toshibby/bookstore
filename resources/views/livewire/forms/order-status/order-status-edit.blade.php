<x-dialog-modal wire:model="isOpenEdit">
    <x-slot name="title">
        <h3>Editar Estado de pedido</h3>
    </x-slot>
    <x-slot name="content">

        <!-- Nombre -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="nombre" value="Nombre del Estado" />
                <x-input wire:model="order_status_form.estado" id="nombre" type="text" class="w-full" />
                <x-input-error for="order_status_form.estado" />
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
