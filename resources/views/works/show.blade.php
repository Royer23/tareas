<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tareas') }}

            <button class="float-right bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded "><a href="{{ route('works.index')}}">Atras</a></button>
        </h2>
        
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>Nombre de la Tarea: <br>{{$work['data']['name']}}</h1>
                    @if ($work['data']['url_image'])
                    <figure>
                        <img class="h-48 w-48 object-cover object-center" src="{{('http://api.prueba.test/storage/'.$work['data']['url_image'])}}" alt="">
                    </figure>
                    @endif
                    <p>Estado: {{$work['data']['status']}}</p>
                    <p>Creado: {{$work['data']['created_at']}}</p>
                    <p>Creado por: {{$work['data']['user']['name']}}</p>
                    <button class=" bg-yellow-300 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded "><a href="{{ route('works.edit',$work['data']['id'])}}">Editar</a></button>
                    <form action="{{ route('works.destroy', $work['data']['id']) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button class=" bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ">Eliminar</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
