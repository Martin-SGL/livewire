<div wire:init="loadPosts">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <x-table>
            <div class="px-6 py-4 flex items-center">
                <div class="flex items-center">
                    <span>Mostar</span>
                    <select wire:model="cant" class="mx-2 form-control">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>entradas</span>
                </div>
                <x-jet-input class="flex-1 mx-4" type="text" wire:model="search" placeholder="Escriba que quiere buscar" />
                @livewire('create-post')
            </div>
            @if (count($posts))
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="w-24 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('id')">
                                ID
                                {{--Sort--}}
                                @if ($sort == 'id')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up float-right mt-1"></i>     
                                    @else
                                    <i class="fas fa-sort-alpha-down float-right mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>    
                                @endif
                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('title')">
                                Title

                                {{--Sort--}}
                                @if ($sort == 'title')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up float-right mt-1"></i>     
                                    @else
                                    <i class="fas fa-sort-alpha-down float-right mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>    
                                @endif
                                
                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('content')">
                                Content
                                {{--Sort--}}
                                @if ($sort == 'content')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up float-right mt-1"></i>     
                                    @else
                                    <i class="fas fa-sort-alpha-down float-right mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>    
                                @endif
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($posts as $item)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">
                                        {{ $item->id }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $item->title }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $item->content }}
                                </td>
                                <td class="px-6 py-4 text-sm font-medium">
                                    <a href="#" class="btn btn-green" wire:click="edit({{$item}})">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        <!-- More people... -->
                    </tbody>
                </table>
                @if ($posts->hasPages())
                    <div class="px-6 py-3">
                        {{$posts->links()}}
                    </div> 
                @endif
            @else
                <div class="px-6 py-4">
                    No existe ningun registro con esas busqueda
                </div>
            @endif
            
            
        </x-table>
    </div>

    <x-jet-dialog-modal wire:model="open_edit">
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
            <x-jet-secondary-button wire:click="$set('open_edit',false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="update()" wire:loading.attr="disabled" wire:target="update(),image">
                Editar post
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
