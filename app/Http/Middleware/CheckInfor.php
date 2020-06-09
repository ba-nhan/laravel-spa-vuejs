<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use DB;

class CheckInfor
{
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role == 1) {
            $idBenhnhan = Auth::id();
            $result = DB::table('benhnhan')
                ->where("user_id", $idBenhnhan)
                ->get();
            $countR = count($result);
            if( $countR == 1){
                return $next($request);
            }else{
               // return response()->json(['error' => 'Unauthorized'], 403);
            }
        }else {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
}
