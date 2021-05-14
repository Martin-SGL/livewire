<div>
    <x-jet-danger-button wire:click="$set('open',true)">
        Crear nuevo post
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Crear un nuevo post
        </x-slot>
        <x-slot name="content">
            
            <div wire:loading.flex wire:target="image" class="items-center mb-2 w-full bg-red-400 p-2 rounded text-white">
                <div class="loader ease-linear rounded-full border-2 border-t-2 border-gray-200 h-6 w-6 mr-2"></div>
                <div>Cargando imagen...</div>
            </div>
            
            {{--imagen--}}
            @if ($image)
                <img src="{{$image->temporaryUrl()}}">
            @endif
            
            

            <div class="mb-4">
                <x-jet-label value="Título del post" />
                <x-jet-input type="text" class="w-full" wire:model.defer="title" />
                <x-jet-input-error for="title" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Cotenido del post" />
                <textarea class="form-control w-full" rows="6" wire:model.defer="content"></textarea>
                <x-jet-input-error for="content" />
            </div>
            <div class="mb-2">
                <input type="file" wire:model="image" id="{{$identificador}}" accept="image/*"/>
                <x-jet-input-error for="image" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="save()" wire:loading.attr="disabled" wire:target="save(),image">
                Crear post
                {{--<span wire:loading wire:target="save()">Cargando...</span>--}}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
