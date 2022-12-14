<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Http;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'email'=>'required|string|email',
            'password' =>'required|string'
        ]);

        $response= Http::withHeaders([
            'Accept' => 'aplication/json'
        ])->post('http://api.prueba.test/api/login',[
            'email' => $request->email,
            'password' => $request->password
        ]);
        if($response->status()==404){
            return back()->withErrors('These credentials do not match our records');
        }

        $user = User::updateOrcreate([
            'email' => $request->email
        ],$response['user']);
        if(!$user->accessToken){
            $user->accessToken()->create([
                'service_id' => $response->json()['user']['id'],
                'access_token' => $response['token']
            ]);    
        }else{
            $user->accessToken()->update([
                'access_token' => $response['token']
            ]); 
        }
        
        Auth::login($user,$request->remember);

        return redirect()->intended(RouteServiceProvider::HOME);
        
        /*$request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);*/
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
