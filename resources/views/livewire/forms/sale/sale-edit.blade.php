<x-dialog-modal wire:model="isOpenEdit">
    <x-slot name="title">
        <h3>Editar Venta</h3>
    </x-slot>
    <x-slot name="content">
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="sale_type_id" value="Tipo de Venta" />
                <select wire:model="sale_create.sale_type_id" id="sale_type_id" class="w-full">
                    <option value="" disabled>Seleccione un tipo de venta</option>
                    @foreach($sale_types as $sale_type)
                        <option value="{{ $sale_type->id }}">{{ $sale_type->tipo }}</option>
                    @endforeach
                </select>
                <x-input-error for="sale_create.sale_type_id" />
            </div>
        </div>

        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="client_id" value="Cliente" />
                <select wire:model="sale_create.client_id" id="client_id" class="w-full">
                    <option value="" disabled>Seleccione un cliente</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->nombre }}</option>
                    @endforeach
                </select>
                <x-input-error for="sale_create.client_id" />
            </div>
        </div>

        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="sub_total" value="Sub Total" />
                <x-input wire:model="sale_create.sub_total" id="sub_total" type="number" step="0.01" class="w-full" />
                <x-input-error for="sale_create.sub_total" />
            </div>
        </div>

        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="igv" value="IGV" />
                <x-input wire:model="sale_create.igv" id="igv" type="number" step="0.01" class="w-full" />
                <x-input-error for="sale_create.igv" />
            </div>
        </div>

        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="total" value="Total" />
                <x-input wire:model="sale_create.total" id="total" type="number" step="0.01" class="w-full" />
                <x-input-error for="sale_create.total" />
            </div>
        </div>

        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="payment_method_id" value="Método de Pago" />
                <select wire:model="sale_create.payment_method_id" id="payment_method_id" class="w-full">
                    <option value="" disabled>Seleccione un método de pago</option>
                    @foreach($payment_methods as $payment_method)
                        <option value="{{ $payment_method->id }}">{{ $payment_method->forma }}</option>
                    @endforeach
                </select>
                <x-input-error for="sale_create.payment_method_id" />
            </div>
        </div>

        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="fecha_venta" value="Fecha de Venta" />
                <x-input wire:model="sale_create.fecha_venta" id="fecha_venta" type="datetime-local" class="w-full" />
                <x-input-error for="sale_create.fecha_venta" />
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
