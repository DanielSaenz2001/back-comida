<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Data\ModuleData;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request){   
        $credentials = request(['username', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'El Usuario o la contraseña estan erroneos.'
            ], 401);
        }
        
        if(auth()->user()->estado == false){
            return response()->json([
                'message' => 'El Usuario no esta autorizado en usar este sistema.'
            ], 401);
        }
        return $this->respondWithToken($token);
    }

    public function me(){
        return response()->json(auth()->user());
    }
    
    public function refresh(){
        return $this->respondWithToken(auth()->refresh());
    }

    private function respondWithToken($token){
        $permisos = ModuleData::getModules(auth()->user()->id);

        return response()->json([
            'access_token'  => $token,
            'token_type'    => 'Bearer',
            'expires_in'    => auth()->factory()->getTTL()." minutos",
            'dni'           => auth()->user()->dni,
            'permisos'      => $permisos
        ],200);

    }
}
