<div>
    <a href="#" class="btn btn-green" wire:click="$set('open',true)">
        <i class="fas fa-edit"></i>
    </a>
    <x-jet-dialog-modal wire:model="open">
        <x-slot name=title>
            Editar post
        </x-slot>
        <x-slot name=content>
            <div wire:loading.flex wire:target="image" class="items-center mb-2 w-full bg-red-400 p-2 rounded text-white">
                <div class="loader ease-linear rounded-full border-2 border-t-2 border-gray-200 h-6 w-6 mr-2"></div>
                <div>Cargando imagen...</div>
            </div>

            @if ($image)
                <img src="{{$image->temporaryUrl()}}">   
            @else
               <img src="{{Storage::url($post->image)}}" alt=""> 
            @endif
            
            <div class="mb-4">
                <x-jet-label value="Título del post" />
                <x-jet-input wire:model.defer="post.title" type="text" class="w-full"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Cotenido del post" />
                <textarea wire:model.defer="post.content" class="form-control w-full" rows="6"></textarea>
            </div>
            <div class="mb-2">
                <input type="file" wire:model="image" id="{{$identificador}}" accept="image/*"/>
            </div>
        </x-slot>
        <x-slot name=footer>
            <x-jet-secondary-button wire:click="$set('open',false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="save()">
                Editar post
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
