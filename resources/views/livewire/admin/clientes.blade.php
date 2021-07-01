<div x-data="{open_destroy: @entangle('open_destroy')}">
    <div class="flex w-full">
        <input wire:model="search" class="w-full input_search" type="text" placeholder="Escriba nombre, negocio o telefono para buscar clientes">
        <button wire:click="init(true)" title="Agregar cliente" class="btn_add"><i class="fas fa-plus-circle"></i></button>
    </div>
    
    <div class="bg-white shadow-md rounded my-6 overflow-y-auto">
        @if ($clientes->count())
            <table class="min-w-max w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal sm:table-row hidden">
                        <th width="20px" class="py-3 px-6 text-left">#</th>
                        <th class="py-3 px-6 text-left">Nombre</th>
                        <th class="py-3 px-6 text-left">Negocio</th>
                        <th class="py-3 px-6 text-left">Teléfono</th>
                        <th class="py-3 px-6 text-left">Domicilio</th>
                        <th width="40px" class="py-3 px-6 text-left">Acciones</th>
                    </tr>
                    <!-- Responsive table head-->
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal sm:hidden">
                        <th width="20px" class="py-3 px-6 text-left">#</th>
                        <th class="py-3 px-6 text-left">Registros</th>
                        <th class="py-3 px-6 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @php   $i=(1 + ($page*$pag)-$pag);   @endphp
                    @foreach ($clientes as $cliente)
                        <tr class="border-b border-gray-200 hover:bg-gray-100 capitalize sm:table-row hidden">
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    {{ $i }}
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    {{ $cliente->nombre }}
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left ">
                                <div class="flex items-center">
                                    {{ $cliente->negocio }}
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left ">
                                <div class="flex items-center">
                                    {{ $cliente->telefono }}
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <ul>
                                        <li>{{ $cliente->calle }}&nbsp;#{{ $cliente->numero }}</li>
                                        <li>{{ $cliente->municipio_estado }}</li>
                                    </ul>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <button wire:click="edit({{$cliente}})" title="Editar cliente" class="btn_edit"><i class="fas fa-edit"></i></button>
                                    <button wire:click="destroy({{$cliente}})" title="Eliminar cliente"class="btn_delete"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                        <!-- Responsive table body-->
                        <tr class="border-b border-gray-200 hover:bg-gray-100 capitalize sm:hidden table-row">
                            <td  class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    {{$i}}
                                </div>
                            </td>
                            <td  class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <ul>
                                        <li> <span class="font-bold">Nombre:</span> {{$cliente->nombre}}</li>
                                        <li> <span class="font-bold">Negocio:</span> {{$cliente->negocio}}</li>
                                        <li> <span class="font-bold">Calle:</span> {{$cliente->calle}}</li>
                                        <li> <span class="font-bold">telefono:</span> {{$cliente->telefono}}</li>
                                        <li> <span class="font-bold">Calle:</span> {{$cliente->calle}} #{{$cliente->numero}}</li>
                                        <li> <span class="font-bold">Calle:</span> {{$cliente->municipio_estado}}</li>
                                    </ul>
                                </div>
                            </td>
                            <td  class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <button wire:click="edit({{$cliente}})" title="Editar cliente" class="btn_edit"><i class="fas fa-edit"></i></button>
                                    <button wire:click="destroy({{$cliente}})" title="Eliminar cliente"class="btn_delete"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                        @php $i++; @endphp
                    @endforeach
                </tbody>
            </table>
            @if ($clientes->hasPages())
                <div class="px-3 py-3 bg-gray-300">
                    {{$clientes->links()}}
                </div>
            @endif
           
         @else
            <div class="px-3 py-2 bg-gray-300 text-white">
                No hay clientes que conincidan con su busqueda
            </div>
         @endif
    </div>

    {{-- Modales --}}
    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            <div class="border-b-2">
            {{$action}} Cliente
            </div>
        </x-slot>
        <x-slot name="content">
            <label class="block mb-2 font-semibold"  for="">Nombre: </label> 
            <input class="mb-3 w-full input_text" wire:model.defer="nombre" type="text" maxlength="50" placeholder="Juan José Sotomayor Amezcua">
            @error('nombre')
                <span class=" text-sm text-red-600">{{$message}}</span>
            @enderror
            <label class="block mb-2 font-semibold"   for="">Negocio: </label> 
            <input class="mb-3 w-full input_text" wire:model.defer="negocio"  type="text"  maxlength="30" placeholder="El Cahuite">
            @error('negocio')
                <span class=" text-sm text-red-600">{{$message}}</span>
            @enderror
            <label class="block mb-2 font-semibold"   for="">Telefono: </label> 
            <input class="mb-3 w-full input_text" wire:model.defer="telefono"  type="number" min="1" max="2" placeholder="3133333243">
            @error('telefono')
                <span class=" text-sm text-red-600">{{$message}}</span>
            @enderror
            <label class="block mb-2 font-semibold"  for="">Calle: </label> 
            <input class="mb-3 w-full input_text" wire:model.defer="calle" type="text" maxlength="45" placeholder="Donato Guerra">
            @error('calle')
                <span class=" text-sm text-red-600">{{$message}}</span>
            @enderror
            <label class="block mb-2 font-semibold"  for="">Numero: </label> 
            <input class="mb-3 w-full input_text" wire:model.defer="numero" type="number" min="1" max="7"  placeholder="57">
            @error('numero')
                <span class=" text-sm text-red-600">{{$message}}</span>
            @enderror
            <label class="block mb-2 font-semibold"  for="">Municipio y Estado: </label> 
            <input class="mb-3 w-full input_text" wire:model.defer="municipio_estado" type="text" maxlength="50" placeholder="Armería, Colima">
            @error('municipio_estado')
                <span class=" text-sm text-red-600">{{$message}}</span>
            @enderror
        </x-slot>
        <x-slot name="footer">
            <button @if($action=="Agregar") class="btn_add" wire:click="store()"  @else class="btn_edit" wire:click="update()" @endif>Guardar</button>
            <button class="btn_close" wire:click="$set('open',close)">Cerrar</button>
        </x-slot>
    </x-jet-dialog-modal>

    {{---Modal Eliminar--}}
    <div x-cloak x-show="open_destroy" 
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
    
        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div @click.away="open_destroy=false" class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <!-- Heroicon name: outline/exclamation -->
                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                        ¿Esta seguro de eliminar el cliente <span class="font-bold">{{$cliente_inicial->nombre}}</span> ?
                    </h3>
                </div>
            </div>
        </div>
        <div class=" bg-gray-100 px-4 py-3 sm:px-6 flex flex-row-reverse">
            <button @click="open_destroy=false" type="button" class="btn_close">
                Cancelar
            </button>
            <button wire:click="destroy_confirmation()" type="button" class="btn_delete">
                Continuar
            </button>
        </div>
    </div>
</div>
