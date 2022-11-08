<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tareas') }}
            <button class="float-right bg-green-900 hover:bg-green-700 text-white font-bold py-2 px-4 rounded "><a href="{{route('works.create')}}">Nueva Tarea</a></button>
        
        </h2>
        
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de Creacion
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Creado por
                                </th>
                                
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Edit/Ver</span>
                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($works['data'] as $work)
                            
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center ">
                                        
                                        
                                            @if ($work['url_image'])
                                                <div class="flex-shrink-0 h-10 w-10">
                                                   
                                                    <img class="h-10 w-10 rounded-full object-cover"
                                                        src="{{('http://api.prueba.test/storage/'.$work['url_image'])}}"
                                                        alt="">
                                                </div>
                                            @endif
                                        <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 capitalize">{{$work['name']}}</div>
                                            
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 capitalize">{{$work['status']}}</div>
                                    
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 capitalize">{{$work['created_at']}}</div>
                                    
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 capitalize">{{$work['user']['name']}}</div>
                                    
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{route('works.show',$work['id'])}}" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                                </td>
                            </tr>
                                
                            @endforeach
                            <!-- More people... -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
