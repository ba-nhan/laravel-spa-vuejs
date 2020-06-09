<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Benhnhan;
use DB;
use Carbon\Carbon;

class BenhNhanController extends Controller
{
    public function postSetting(Request $request){
        $v = Validator::make($request->all(), [
            'tenbn' => 'required',
            'gtbn' => 'required',
            'nsbn' => 'required',
            'sodtbn' => 'required',
            'socmbn' => 'required',
            'diachibn' => 'required',
            ],
            [
            'tenbn.required' => 'Họ và tên là trường bắt buộc',
            'gtbn.required' => 'Giới tính là trường bắt buộc',
            'nsbn.required' => 'Ngày sinh là trường bắt buộc',
            'sodtbn.required' => 'Số điện thoại là trường bắt buộc',
            'socmbn.required' => 'Chứng mình thư là trường bắt buộc',
            'diachibn.required' => 'Địa chỉ bệnh nhân là trường bắt buộc',
            ]
        );

        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }
        else{
    	// $user = JWTAuth::toUser($request->token);

     		$userId=Auth::id();
            $result = DB::table('benhnhan')
                ->where('user_id', $userId)
                ->get();
            if(count($result) == 0){
                Benhnhan::create([
                    'tenbn' => $request->tenbn ,
                    'gioitinhbn' => $request->gtbn,
                    'namsinhbn' => $request->nsbn,
                    'sodtbn' => $request->sodtbn,
                    'socmbn' => $request->socmbn,
                    'diachibn' => $request->diachibn,
                    'user_id' => $userId,
                ]);
                return response()->json(['status' => 'success'], 200);
            }else{
                return response()->json("exist");
            }
        }
    }
    public function hoso()
    {
    	$userId=Auth::id();
    	$result = DB::table('benhnhan')
    		->select('tenbn','gioitinhbn','namsinhbn','sodtbn','socmbn','diachibn')
            ->join('users', 'benhnhan.user_id', '=', 'users.id')
            ->where('user_id', $userId)
            ->get();
         //Kiểm tra bệnh nhân có tồn tại không
        $checkExist = DB::table('benhnhan')
            ->where('user_id', $userId)
            ->get();
        $countE = count($checkExist);
        // 0 là 'Không'; 1 là 'Có'
        return response()->json(['result' => $result, 'countE' => $countE]);
    }
    public function checkNotInfo(){
    	$userId=Auth::id();
    	$result = DB::table('benhnhan')
    		->join('users', 'benhnhan.user_id', '=', 'users.id')
    		->where('user_id', $userId)
            ->value('user_id');
        if($result){
        	return response()->json('exist');
        }
        else{
        	return response()->json('unexist');
        }
    }
    public function lichsukbbn(){
        $a = Auth::id();
        $history_BN = DB::table('toathuoc')->select('toathuoc.id','tencs','diachi','sodtpk','tenck','thoigiandt','sokb','chuandoan','loidan', 'taikham')
            ->join('phieukham', 'toathuoc.phieukham_id', '=', 'phieukham.id')
            ->join('benhnhan', 'phieukham.benhnhan_id', '=', 'benhnhan.id')
            ->join('phongkham', 'phieukham.phongkham_id', '=', 'phongkham.id')
            ->join('chuyenkhoa', 'phongkham.chuyenkhoa_id', '=', 'chuyenkhoa.id')
            ->where('benhnhan.user_id', $a)
            ->orderBy('toathuoc.thoigiandt', 'desc')
            ->get();
        $thuoc = DB::table('chitietthuoc')
            ->get();
        $response = [
            'history_BN'=> $history_BN,
            'thuoc' => $thuoc,
        ];
        return response()->json($response);
    }
}
