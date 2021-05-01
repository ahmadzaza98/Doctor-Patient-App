<?php

namespace App\Http\Middleware;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Closure;
use Illuminate\Http\Request;

class AssignGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next , $guard = null)
    {
        // if($guard != null){
            try{
                $user = JWTAuth::parseToken()->authenticate();
            }catch(Exception $ex){
                if ($ex instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                    return response()->json(['status' => 'Token is Invalid']);
                }else if ($ex instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                    return response()->json(['status' => 'Token is Expired']);
                }else{
                    return response()->json(['status' => 'Authorization Token not found']);
                }
            }
        // }
        return $next($request);
    }
}
