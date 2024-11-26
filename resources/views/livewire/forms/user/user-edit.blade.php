<x-dialog-modal wire:model="isOpenEdit">
    <x-slot name="title">
        <h3>Editar Usuario</h3>
    </x-slot>
    <x-slot name="content">
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="name" value="Nombre" />
                <x-input wire:model="user_create.name" id="name" type="text" class="w-full" />
                <x-input-error for="user_create.name" />
            </div>
        </div>

        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="apellido_paterno" value="Apellido Paterno" />
                <x-input wire:model="user_create.apellido_paterno" id="apellido_paterno" type="text" class="w-full" />
                <x-input-error for="user_create.apellido_paterno" />
            </div>
        </div>

        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="apellido_materno" value="Apellido Materno" />
                <x-input wire:model="user_create.apellido_materno" id="apellido_materno" type="text" class="w-full" />
                <x-input-error for="user_create.apellido_materno" />
            </div>
        </div>

        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="password" value="Contraseña" />
                <x-input wire:model="user_create.password" id="password" type="password" class="w-full" />
                <x-input-error for="user_create.password" />
            </div>
        </div>

        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="dni" value="DNI" />
                <x-input wire:model="user_create.dni" id="dni" type="text" class="w-full" />
                <x-input-error for="user_create.dni" />
            </div>
        </div>

        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="foto_usuario" value="Foto del Usuario" />
                <x-input wire:model="user_create.foto_usuario" id="foto_usuario" type="text" class="w-full" />
                <x-input-error for="user_create.foto_usuario" />
            </div>
        </div>

        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="direccion" value="Dirección" />
                <x-input wire:model="user_create.direccion" id="direccion" class="w-full" rows="4" />
                <x-input-error for="user_create.direccion" />
            </div>
        </div>

        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-label for="email" value="Correo Electrónico" />
                <x-input wire:model="user_create.email" id="email" type="email" class="w-full" />
                <x-input-error for="user_create.email" />
            </div>
        </div>
    </x-slot>
    <x-slot name="footer">
        <x-secondary-button wire:click="$set('isOpenEdit', false)" class="mx-2">Cancelar</x-secondary-button>
        <x-button wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="store" class="disabled:opacity-25">
            Actualizar
        </x-button>
    </x-slot>
</x-dialog-modal>
