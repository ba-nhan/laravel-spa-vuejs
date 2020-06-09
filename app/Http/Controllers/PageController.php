<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Phongkham;

class PageController extends Controller
{
    public function index(){
		$items = DB::table('chuyenkhoa')
	    	->select('phongkham.id', 'tencs', 'tenck','sodtpk')
	        ->join('phongkham','phongkham.chuyenkhoa_id', '=', 'chuyenkhoa.id')
	        ->orderBy('phongkham.ngaycp', 'desc')
	        ->paginate(12);
	    $paginate = [
	    	'total' 		=> $items->total(),
            'per_page' 		=> $items->perPage(),
            'current_page' 	=> $items->currentPage(),
            'last_page' 	=> $items->lastPage(),
            'from' 			=> $items->firstItem(),
            'to' 			=> $items->lastItem()
	    ];


	    $items_mb = DB::table('chuyenkhoa')
	    	->select('phongkham.id', 'tencs', 'tenck','sodtpk')
	        ->join('phongkham','phongkham.chuyenkhoa_id', '=', 'chuyenkhoa.id')
	        ->orderBy('phongkham.ngaycp', 'desc')
	        ->paginate(4);
	    $paginate_mb = [
	    	'total' 		=> $items_mb->total(),
            'per_page' 		=> $items_mb->perPage(),
            'current_page' 	=> $items_mb->currentPage(),
            'last_page' 	=> $items_mb->lastPage(),
            'from' 			=> $items_mb->firstItem(),
            'to' 			=> $items_mb->lastItem()
	    ];
	    
        $response = [
            'pagination' => $paginate,
            'data' => $items,
            'pagination_mb' => $paginate_mb,
            'data_mb' => $items_mb,
        ];

        return response()->json($response);
	}
	public function filter_clinic(Request $request){
    	$idck = $request->id_chuyenkhoa;
	    if($idck){
			$items = DB::table('chuyenkhoa')
		    	->select('phongkham.id', 'tencs', 'tenck','sodtpk')
		    	->where('chuyenkhoa.id', $idck)
		        ->join('phongkham','phongkham.chuyenkhoa_id', '=', 'chuyenkhoa.id')
		        ->orderBy('phongkham.ngaycp', 'desc')
		        ->paginate(12);
		    $items_mb = DB::table('chuyenkhoa')
		    	->select('phongkham.id', 'tencs', 'tenck','sodtpk')
		    	->where('chuyenkhoa.id', $idck)
		        ->join('phongkham','phongkham.chuyenkhoa_id', '=', 'chuyenkhoa.id')
		        ->orderBy('phongkham.ngaycp', 'desc')
		        ->paginate(4);
		}
	    $paginate = [
	    	'total' 		=> $items->total(),
            'per_page' 		=> $items->perPage(),
            'current_page' 	=> $items->currentPage(),
            'last_page' 	=> $items->lastPage(),
            'from' 			=> $items->firstItem(),
            'to' 			=> $items->lastItem()
	    ];
	    $paginate_mb = [
	    	'total' 		=> $items_mb->total(),
            'per_page' 		=> $items_mb->perPage(),
            'current_page' 	=> $items_mb->currentPage(),
            'last_page' 	=> $items_mb->lastPage(),
            'from' 			=> $items_mb->firstItem(),
            'to' 			=> $items_mb->lastItem()
	    ];
	    
        $response = [
            'pagination' => $paginate,
            'data' => $items,
            'pagination_mb' => $paginate_mb,
            'data_mb' => $items_mb,
        ];

        return response()->json($response);
	}
}
