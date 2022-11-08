<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WorkController extends Controller
{
    public function index()
    {
        $data = Http::withHeaders([
            'Accept' => 'application/json'
        ])->get('http://api.prueba.test/api/works?included=user&sort=-id');
        $works= $data;
        return view('works.index')->with('works', ($works));
    }
    /*public function store(){
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . auth()->user()->accessToken->access_token
        ])->post('http://api.prueba.test/api/works',[
            'name' =>'tarea de prueba',

        ]);
        return $response->json();
    }*/
    public function show($id){//mostrar elemento en particular

        //compact('curso'); //['curso'=> $curso]
        $work = Http::withHeaders([
            'Accept' => 'application/json'
        ])->get('http://api.prueba.test/api/works/'.$id.'?included=user');
        
        
        return view('works.show',compact('work'));
    }
    public function create(){//formulario para crear
        return view('works.create');
    }
    public function store(Request $request){
        if($request->image){
            $request->validate([
                'name' => 'required',
                'image' =>'image'
            ]);
            $response = Http::attach(
                'image',fopen($request->file('image'),'r')
            )->withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . auth()->user()->accessToken->access_token
            ])->post('http://api.prueba.test/api/works',[
                'name' =>$request->name,
                //'image' => file_get_contents($request->file('image'))
            ]);
    
        }else{
            $request->validate([
                'name' => 'required'
            ]);
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . auth()->user()->accessToken->access_token
            ])->post('http://api.prueba.test/api/works',[
                'name' =>$request->name,
                //'image' => file_get_contents($request->file('image'))
            ]);
            
        }

        
        $data=$response->json();
        
        $work = Http::withHeaders([
            'Accept' => 'application/json'
        ])->get('http://api.prueba.test/api/works/'.$data['data']['id'].'?included=user');
        
        return view('works.show',compact('work'));
    }
    public function edit($id){//laravel entiende y recupera segun id
        $work = Http::withHeaders([
            'Accept' => 'application/json'
        ])->get('http://api.prueba.test/api/works/'.$id.'?included=user');
        
        return view('works.edit', compact('work'));
    }

    public function update(Request $request, $id){
        
        
        if($request->image){
            $request->validate([
                'name' => 'required',
                'status'=>'required',
                'image' =>'image'
            ]);
            
            $response = Http::attach(
                'image',fopen($request->file('image'),'r')
            )->withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . auth()->user()->accessToken->access_token
            ])->post('http://api.prueba.test/api/works/'.$id,$request->all());
            
    
        }else{
            $request->validate([
                'name' => 'required',
                'status'=>'required',
            ]);
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . auth()->user()->accessToken->access_token
            ])->put('http://api.prueba.test/api/works/'.$id,[
                'name' =>$request->name,
                'status'=>$request->status
            ]);
        }
        
        $data=$response->json();
        
        $work = Http::withHeaders([
            'Accept' => 'application/json'
        ])->get('http://api.prueba.test/api/works/'.$data['data']['id'].'?included=user');

        return view('works.show',compact('work'));
    }

    public function destroy($id){
        $work = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . auth()->user()->accessToken->access_token
        ])->delete('http://api.prueba.test/api/works/'.$id);
        return redirect()->route('works.index');
    }

}
