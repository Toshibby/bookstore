<x-dialog-modal wire:model="isOpenEdit">
    <x-slot name="title">
        <h3>Editar Categoría</h3>
    </x-slot>
    <x-slot name="content">

        <!-- Tipo -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="tipo" value="Tipo" />
                <x-input wire:model="category_create.tipo" id="tipo" type="text" class="w-full" />
                <x-input-error for="category_create.tipo" />
            </div>
        </div>

        <!-- Descripción -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="descripcion" value="Descripción" />
                <x-input wire:model="category_create.descripcion" id="descripcion" class="w-full" />
                <x-input-error for="category_create.descripcion" />
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
