<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('auth.login'); //Retorna la vista login
    }

    public function login(Request $request){
        $this->validateLogin($request); //Enviar el objeto para validar

        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            return redirect()->route('main'); //Si el usuario existe, redirigir al main
        }
        //Retorno error de autenticacion traducido del archivo auth con la opcion failed
        return back()
        ->withErrors(['email' => trans('auth.failed')])
        ->withInput(request(['email'])); 
    }

    protected function validateLogin(Request $request){
        $this->validate($request, [
            'email'=>'required|string',
            'password'=>'required|string'
        ]); //Datos a validar
    }

    

   
}
