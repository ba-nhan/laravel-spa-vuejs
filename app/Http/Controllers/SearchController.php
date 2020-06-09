<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SearchController extends Controller
{
    public function search(Request $request){
    	$keysearch = $request->keysearch;
    	$items = DB::table('chuyenkhoa')
    		->select('phongkham.id', 'tencs', 'sodtpk', 'tenbs', 'diachi', 'tenck', 'ngaycp')
            ->join('phongkham','phongkham.chuyenkhoa_id', '=', 'chuyenkhoa.id')
            ->where('tencs','like', '%'.$keysearch.'%')
            ->orwhere('tenbs','like', '%'.$keysearch.'%')
            ->orwhere('diachi','like', '%'.$keysearch.'%')
            ->orderBy('phongkham.ngaycp', 'desc')
            ->get();
        $countSearch = count($items);
        $response = [
            'items' 		=> $items,
            'countSearch'	=> $countSearch
        ];
        return response()->json($response);
    }
}
