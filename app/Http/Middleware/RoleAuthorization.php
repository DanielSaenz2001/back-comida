<?php

namespace App\Http\Middleware;

use Closure;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Http\Request;

use App\Models\Seguridad\PermisoUser;

class RoleAuthorization{
    
    public function handle(Request $request, Closure $next, $code){
        try {  
            $token = JWTAuth::parseToken();
            $user = $token->authenticate();
        } catch (TokenExpiredException $e) {   
            return $this->unauthorized('Tu token ha caducado. Por favor, inicie sesión nuevamente.');
        } catch (TokenInvalidException $e) {
            return $this->unauthorized('Tu token no es válido. Por favor, inicie sesión nuevamente.');
        }catch (JWTException $e) {
            return $this->unauthorized('Por favor, adjunte un token de portador a su solicitud.');
        }

        $permiso = PermisoUser::join('permisos','permisos.id','permiso_users.permiso_id')
        ->where('permiso_users.user_id',$user->id)
        ->where('permisos.codigo', $code)->first();
        if(!$permiso){
            return $this->unauthorized();
        }else{
            return $next($request);
        }
    }

    private function unauthorized($message = null){
        return response()->json([
            'error' => 'Autorización',
            'message' => $message ? $message : 'No está autorizado para acceder a este recurso.',
            'success' => false
        ], 401);
    }
}
