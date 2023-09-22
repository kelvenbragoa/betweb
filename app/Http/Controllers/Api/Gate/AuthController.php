<?php

namespace App\Http\Controllers\Api\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login(Request $request){
        $data = $request->all();

        if(!Auth::attempt($data)){
            return response(
               [ 'message' => 'Usuario/Password Incorretos'], 403
            );
        }
        

        $array = array(
            'id' => auth()->user()->id,
            'name' => auth()->user()->name,
            'username' => auth()->user()->username,
            'email' => auth()->user()->email,
            'role' => auth()->user()->role->name       
        );
       
        
        return response([
            'user' => $array,
        ],200);
       
   
    }
}
