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
                    <form action="{{route('works.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label>
                            Nombre:
                            <br>
                            <input type="text" name="name" value="">
                        </label>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        <br>
                        <label>
                            Imagen:
                            <br>
                            <input type="file" name="image" >
                        </label>
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        <br>
                        <button class="my-5 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" type="submit">Enviar formulario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>