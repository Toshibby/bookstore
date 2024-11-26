<x-dialog-modal wire:model="isOpen">
    <x-slot name="title">
        <h3>Registrar Método de Pago</h3>
    </x-slot>
    <x-slot name="content">

        <!-- Forma de Pago -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="forma" value="Forma de Pago" />
                <x-input wire:model="payment_method_create.forma" id="forma" type="text" class="w-full" />
                <x-input-error for="payment_method_create.forma" />
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
