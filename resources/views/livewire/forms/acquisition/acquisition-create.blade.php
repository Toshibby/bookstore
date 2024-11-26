<x-dialog-modal wire:model="isOpen">
    <x-slot name="title">
        <h3>Registrar Adquisición</h3>
    </x-slot>
    <x-slot name="content">

        <!-- Proveedor -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="supplier_id" value="Proveedor" />
                <select wire:model="acquisition_create.supplier_id" id="supplier_id" class="w-full">
                    <option value="" disabled>Seleccione un proveedor</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->nombre }}</option>
                    @endforeach
                </select>
                <x-input-error for="acquisition_create.supplier_id" />
            </div>
        </div>

        <!-- Fecha de Adquisición -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="fecha_adquisicion" value="Fecha de Adquisición" />
                <x-input wire:model="acquisition_create.fecha_adquisicion" id="fecha_adquisicion" type="date" class="w-full" />
                <x-input-error for="acquisition_create.fecha_adquisicion" />
            </div>
        </div>

        <!-- Monto Total -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="monto_total" value="Monto Total" />
                <x-input wire:model="acquisition_create.monto_total" id="monto_total" type="number" step="0.01" min="0" class="w-full" />
                <x-input-error for="acquisition_create.monto_total" />
            </div>
        </div>

        <!-- Estado -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="estado" value="Estado" />
                <select wire:model="acquisition_create.estado" id="estado" class="w-full">
                    <option value="" disabled>Seleccione el estado</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="completado">Completado</option>
                    <option value="cancelado">Cancelado</option>
                </select>
                <x-input-error for="acquisition_create.estado" />
            </div>
        </div>

        <!-- Detalle -->
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="detalle" value="Detalle" />
                <x-input wire:model="acquisition_create.detalle" id="detalle" class="w-full" />
                <x-input-error for="acquisition_create.detalle" />
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
