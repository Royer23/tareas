<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nueva Tarea') }}
        </h2>
        
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{route('works.update',$work['data']['id'])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <label>
                            Nombre:
                            <br>
                            <input type="text" name="name" value="{{$work['data']['name']}}">
                        </label>
                        <br>
                        <label>
                            Estado:
                            
                            <br>
                            @if ($work['data']['status']=='No Realizado')
                            <input type="radio"  name="status" value="1" checked>No Realizado <br>
                            <input type="radio"  name="status" value="2">Realizado
                            @else
                            <input type="radio"  name="status" value="1" >No Realizado <br>
                            <input type="radio"  name="status" value="2" checked>Realizado 
                            @endif
                            
                            
                        </label>
                        <br>
                        <label>
                            Imagen:
                            <br>
                            @if ($work['data']['url_image'])
                            <figure>
                                <img class="h-48 w-48 object-cover object-center" src="{{('http://api.prueba.test/storage/'.$work['data']['url_image'])}}" alt="">
                            </figure>
                            @endif
                            <br>
                            <input type="file" name="image" >
                        </label>
                        <br>
                        <button class="my-5 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" type="submit">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>