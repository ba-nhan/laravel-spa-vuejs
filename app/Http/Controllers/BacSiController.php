<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Phongkham;
use Auth;
use Carbon\Carbon;
use App\Bangtin;
use App\Toathuoc;
use App\Khungtime;
use App\Thuoc;
use App\Chitietthuoc;

class BacSiController extends Controller
{
    public function trinhdo(){
    	$result = DB::table('trinhdo')
    		->orderBy('trinhdo', 'asc')
    		->get();
    	return response()->json($result);
    }
    public function chuyenkhoa(){
    	$result = DB::table('chuyenkhoa')
    		->orderBy('tenck', 'asc')
    		->get();
    	return response()->json($result);
    }
    public function tinh(){
    	$result = DB::table('tinh')
    		->orderBy('name', 'asc')
    		->get();
    	return response()->json($result);
    }
    public function noict(Request $request){
        $result = DB::table("noicongtac")
        ->where("tinh_id",$request->id)
        ->get();
        return response()->json($result);
    }
    public function luuhoso(Request $request){
        $rules =[
            'tencs'         => 'required',
            'ngaycp'        => 'required',
            'tenbs'         => 'required',
            'nsbs'          => 'required',
            'gtbs'          => 'required',
            'trinhdobs'     => 'required',
            'tenck'         => 'required',
            'noicongtac'    => 'required',
            'diachipk'      => 'required',
            'sodtpk'        => 'required',
            'timestart'     => 'required',
            'timeend'       => 'required',
            'timetb'        => 'required',
            'layoutpk'      => 'required',
            ];
        $messages =[
            'tencs.required'        => 'Trường bắt buộc(*)',
            'ngaycp.required'       => 'Trường bắt buộc(*)',
            'tenbs.required'        => 'Trường bắt buộc(*)',
            'nsbs.required'         => 'Trường bắt buộc(*)',
            'gtbs.required'         => 'Trường bắt buộc(*)',
            'trinhdobs.required'    => 'Trường bắt buộc(*)',
            'tenck.required'        => 'Trường bắt buộc(*)',
            'noicongtac.required'   => 'Trường bắt buộc(*)',
            'diachipk.required'     => 'Trường bắt buộc(*)',
            'sodtpk.required'       => 'Trường bắt buộc(*)',
            'timestart.required'    => 'Trường bắt buộc(*)',
            'timetb.required'       => 'Trường bắt buộc(*)',
            'layoutpk.required'     => 'Trường bắt buộc(*)',
        ];

        if($request->vido || $request->kinhdo){
            $a =[
                'vido'    => 'required',
                'kinhdo'  => 'required',
            ];
            $rules = array_merge($rules,$a);
        }
        if($request->timestart2 || $request->timeend2){
            $a =[
                'timestart2'    => 'required',
                'timeend2'      => 'required',
            ];
            $rules = array_merge($rules,$a);
        }
        if($request->timestart3 || $request->timeend3){
            $a =[
                'timestart3'    => 'required',
                'timeend3'      => 'required',
            ];
            $rules = array_merge($rules,$a);
        }
        $v = Validator::make($request->all(), $rules,$messages);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }
        else{
        	$a=Auth::id();
            $b1 = $request->timestart;
            $c1 = $request->timeend;

            $b2 = $request->timestart2;
            $c2 = $request->timeend2;
            $b3 = $request->timestart3;
            $c3 = $request->timeend3;

            $checkFrame = DB::table('khungthoigian')
                ->where('timestart', $b1)
                ->where('timeend', $c1)
                ->get();
            $countF = count($checkFrame);
            if($countF == 0){
                Khungtime::create([
                    'timestart' => $b1,
                    'timeend'   => $c1,
                ]);
            }
            $time1 = DB::table('khungthoigian')
                ->where('timestart', $b1)
                ->where('timeend', $c1)
                ->value('id');

            
            if($b2 && $c2){
                $checkFrame = DB::table('khungthoigian')
                    ->where('timestart', $b2)
                    ->where('timeend', $c2)
                    ->get();
                $countF = count($checkFrame);
                if($countF == 0){
                    Khungtime::create([
                        'timestart' => $b2,
                        'timeend'   => $c2,
                    ]);
                }
                $time2 = DB::table('khungthoigian')
                    ->where('timestart', $b2)
                    ->where('timeend', $c2)
                    ->value('id');
            }
            if($b3 && $c3){
                $checkFrame = DB::table('khungthoigian')
                    ->where('timestart', $b3)
                    ->where('timeend', $c3)
                    ->get();
                $countF = count($checkFrame);
                if($countF == 0){
                    Khungtime::create([
                        'timestart' => $b3,
                        'timeend'   => $c3,
                    ]);
                }
                $time3 = DB::table('khungthoigian')
                    ->where('timestart', $b3)
                    ->where('timeend', $c3)
                    ->value('id');
            }

            $ngaycp = $request->ngaycp;
            $ngaycp = strtotime($ngaycp);
            $b = date('d-m-Y', $ngaycp);

            $ngaysinh = $request->nsbs;
            $ngaysinh = strtotime($ngaysinh);
            $c = date('d-m-Y', $ngaysinh);

            //Kiểm tra phòng khám có tồn tại không
            $checkExist = DB::table('phongkham')
                ->where('user_id', $a)
                ->get();
            $countE = count($checkExist);
            // 0 là 'Không'; 1 là 'Có'
            if($countE == 0){
                if(empty($time2) && empty($time3)){
                    Phongkham::create([
                        'user_id'           => $a ,
                        'tencs'             => $request->tencs ,
                        'ngaycp'            => $b ,
                        'tenbs'             => $request->tenbs ,
                        'nsbs'              => $c ,
                        'gioitinhbs'        => $request->gtbs ,
                        'trinhdo_id'        => $request->trinhdobs ,
                        'chuyenkhoa_id'     => $request->tenck ,
                        'noicongtac_id'     => $request->noicongtac ,
                        'diachi'            => $request->diachipk ,
                        'iframe_map'        => $request->iframe_map ,
                        'sodtpk'            => $request->sodtpk ,
                        'khung1_id'         => $time1 ,
                        'timetb'            => $request->timetb ,
                        'layout'            => $request->layoutpk ,
                        'vido'              => $request->vido ,
                        'kinhdo'            => $request->kinhdo ,
                    ]);
                }else if(empty($time3)){
                    Phongkham::create([
                        'user_id'           => $a ,
                        'tencs'             => $request->tencs ,
                        'ngaycp'            => $b ,
                        'tenbs'             => $request->tenbs ,
                        'nsbs'              => $c ,
                        'gioitinhbs'        => $request->gtbs ,
                        'trinhdo_id'        => $request->trinhdobs ,
                        'chuyenkhoa_id'     => $request->tenck ,
                        'noicongtac_id'     => $request->noicongtac ,
                        'diachi'            => $request->diachipk ,
                        'iframe_map'        => $request->iframe_map ,
                        'sodtpk'            => $request->sodtpk ,
                        'khung1_id'         => $time1 ,
                        'khung2_id'         => $time2 ,
                        'timetb'            => $request->timetb ,
                        'layout'            => $request->layoutpk ,
                        'vido'              => $request->vido ,
                        'kinhdo'            => $request->kinhdo ,
                    ]);
                }else {
                    Phongkham::create([
                        'user_id'           => $a ,
                        'tencs'             => $request->tencs ,
                        'ngaycp'            => $b ,
                        'tenbs'             => $request->tenbs ,
                        'nsbs'              => $c ,
                        'gioitinhbs'        => $request->gtbs ,
                        'trinhdo_id'        => $request->trinhdobs ,
                        'chuyenkhoa_id'     => $request->tenck ,
                        'noicongtac_id'     => $request->noicongtac ,
                        'diachi'            => $request->diachipk ,
                        'iframe_map'        => $request->iframe_map ,
                        'sodtpk'            => $request->sodtpk ,
                        'khung1_id'         => $time1 ,
                        'khung2_id'         => $time2 ,
                        'khung3_id'         => $time3 ,
                        'timetb'            => $request->timetb ,
                        'layout'            => $request->layoutpk ,
                        'vido'              => $request->vido ,
                        'kinhdo'            => $request->kinhdo ,
                    ]);
                }
	    		return response()->json(['status' => 'success'], 200);
            }else{
            	return response()->json('exist');
            }
        }
    }
    public function hoso(){
        $userId=Auth::id();
        $info = DB::table('phongkham')
            ->select('tencs','ngaycp','tenbs','nsbs','gioitinhbs','trinhdo','tenck', 'name','diachi','sodtpk', 'timetb', 'iframe_map','vido', 'kinhdo')
            ->join('trinhdo', 'phongkham.trinhdo_id', '=', 'trinhdo.id')
            ->join('chuyenkhoa', 'phongkham.chuyenkhoa_id', '=', 'chuyenkhoa.id')
            ->join('noicongtac', 'phongkham.noicongtac_id', '=', 'noicongtac.id')
            ->where('user_id', $userId)
            ->get();
        $time_s1 = DB::table('phongkham')
            ->join('khungthoigian', 'phongkham.khung1_id', '=', 'khungthoigian.id')
            ->where('user_id', $userId)
            ->value('timestart');
        $time_e1 = DB::table('phongkham')
            ->join('khungthoigian', 'phongkham.khung1_id', '=', 'khungthoigian.id')
            ->where('user_id', $userId)
            ->value('timeend');
        $time_s2 = DB::table('phongkham')
            ->join('khungthoigian', 'phongkham.khung2_id', '=', 'khungthoigian.id')
            ->where('user_id', $userId)
            ->value('timestart');
        $time_e2 = DB::table('phongkham')
            ->join('khungthoigian', 'phongkham.khung2_id', '=', 'khungthoigian.id')
            ->where('user_id', $userId)
            ->value('timeend');
        $time_s3 = DB::table('phongkham')
            ->join('khungthoigian', 'phongkham.khung3_id', '=', 'khungthoigian.id')
            ->where('user_id', $userId)
            ->value('timestart');
        $time_e3 = DB::table('phongkham')
            ->join('khungthoigian', 'phongkham.khung3_id', '=', 'khungthoigian.id')
            ->where('user_id', $userId)
            ->value('timeend');

        $time_s1 = date ('H:i',strtotime($time_s1));
        $time_e1 = date ('H:i',strtotime($time_e1));
        $time_s2 = date ('H:i',strtotime($time_s2));
        $time_e2 = date ('H:i',strtotime($time_e2));
        $time_s3 = date ('H:i',strtotime($time_s3));
        $time_e3 = date ('H:i',strtotime($time_e3));

        //Kiểm tra phòng khám có tồn tại không
        $checkExist = DB::table('phongkham')
            ->where('user_id', $userId)
            ->get();
        $countE = count($checkExist);
        // 0 là 'Không'; 1 là 'Có'

        return response()->json(['info' => $info, 'time_s1' => $time_s1, 'time_e1' => $time_e1, 'time_s2' => $time_s2, 'time_e2' => $time_e2, 'time_s3' => $time_s3, 'time_e3' => $time_e3, 'countE' => $countE]);
    }
    public function checkNotInfo(){
        $userId=Auth::id();
        $result = DB::table('phongkham')
            ->where('user_id', $userId)
            ->value('user_id');
        if($result){
            return response()->json('exist');
        }
        else{
            return response()->json('unexist');
        }
    }
    public function hienthidanhsachkb(){
        $a=Auth::id();
        $datetimeNow = Carbon::now('Asia/Ho_Chi_Minh');
        $timeNow = $datetimeNow->toTimeString();
        $dateNow = $datetimeNow->toDateString();

        $check = DB::table('phieukham')
            ->select('phieukham.sokb', 'timestart')
            ->join('toathuoc', 'phieukham.id', '=', 'toathuoc.phieukham_id')
            ->join('phongkham', 'phieukham.phongkham_id', '=', 'phongkham.id')
            ->join('khungthoigian', 'phieukham.khungtime_id', '=', 'khungthoigian.id')
            ->where('phongkham.user_id', $a)
            ->whereDate('thoigian',$dateNow)
            ->get();

        $list_patient = DB::table('phieukham')
            ->select('phieukham.id','sokb','tenbn', 'gioitinhbn', 'sodtbn', 'diachibn','timestart','timeend')
            ->join('phongkham', 'phieukham.phongkham_id', '=', 'phongkham.id')
            ->join('benhnhan', 'phieukham.benhnhan_id', '=', 'benhnhan.id')
            ->join('khungthoigian', 'phieukham.khungtime_id', '=', 'khungthoigian.id')
            ->where('phongkham.user_id', $a)
            ->whereDate('thoigian',$dateNow)
            // ->orderBy('timestart', 'desc')
            // ->orderBy('sokb', 'desc')
            ->orderBy('timestart', 'asc')
            ->orderBy('sokb', 'asc')
            ->get();

        $time_start = DB::table('phieukham')
            ->join('phongkham', 'phieukham.phongkham_id', '=', 'phongkham.id')
            ->join('khungthoigian', 'phieukham.khungtime_id', '=', 'khungthoigian.id')
            ->where('phongkham.user_id', $a)
            ->whereDate('thoigian',$dateNow)
            ->value('timestart');
        $time_end = DB::table('phieukham')
            ->join('phongkham', 'phieukham.phongkham_id', '=', 'phongkham.id')
            ->join('khungthoigian', 'phieukham.khungtime_id', '=', 'khungthoigian.id')
            ->where('phongkham.user_id', $a)
            ->whereDate('thoigian',$dateNow)
            ->value('timeend');
        $time_start = date ('H:i',strtotime($time_start));
        $time_end = date ('H:i',strtotime($time_end));

        $response =[
            'list_patient'  => $list_patient,
            'time_start'    => $time_start,
            'time_end'      => $time_end,
            'timeNow'       => $timeNow,
            'check'         => $check
        ];
        return response()->json($response);
    }
    public function ketqualayso(Request $request){
        $iddk = $request->iddk;
        $db = DB::table("phieukham")
            ->select("tencs", "tenbn", "sokb")
            ->join("phongkham", "phongkham.id" ,"phieukham.phongkham_id")
            ->join("benhnhan", "phieukham.benhnhan_id", "=", "benhnhan.id")
            ->where("phieukham.id", $iddk)
            ->get();
        return response()->json($db);
    }
    //Sử dụng Bootstrap Typeahead JS
    public function autocomplete(Request $request){
        $search = $request->keysearch;
        
        $result = DB::table('thuoc')
            ->select('name')
            ->where('name', 'LIKE', '%'. $search. '%')
            ->orderBy('name','asc')
            ->get();
        return response()->json($result);
    }

    public function namethuoc(){
        $result = DB::table('thuoc')
            ->orderBy('name', 'asc')
            ->get('name');
        return response()->json($result);
    }
    public function luuKetquakhambenh(Request $request){
        $rules =[
            'chuandoan'     => 'required',
            'search1'       => 'required',
            'soluong1'      => 'required',
            'type_soluong1' => 'required',
            'chon_1ngay1'   => 'required',
            'moilan1'       => 'required',
        ];
        $messages =[
            'chuandoan.required'=> 'Trường bắt buộc(*)',
        ];

        if(!$request->uongbuoi1){
            $a =[
                'uongbuoi1' => 'required',
            ];
            $rules = array_merge($rules,$a);
        }
        if($request->input("uongbuoi2")){
            $a =[
                'search2'       => 'required',
                'soluong2'      => 'required',
                'type_soluong2' => 'required',
                'chon_1ngay2'   => 'required',
                'moilan2'       => 'required',
            ];
            $rules = array_merge($rules,$a);
        }
        else if($request->input("fields.search2") || $request->input("fields.soluong2") || $request->input("fields.type_soluong2") || $request->input("fields.chon_1ngay2") || $request->input("fields.moilan2") ){
            $a =[
                'search2'       => 'required',
                'soluong2'      => 'required',
                'type_soluong2' => 'required',
                'chon_1ngay2'   => 'required',
                'moilan2'       => 'required',
                'uongbuoi2'     => 'required',
            ];
            $rules = array_merge($rules,$a);
        }
        if($request->input("uongbuoi3")){
            $a =[
                'search3'       => 'required',
                'soluong3'      => 'required',
                'type_soluong3' => 'required',
                'chon_1ngay3'   => 'required',
                'moilan3'       => 'required',
            ];
            $rules = array_merge($rules,$a);
        }
        else if($request->input("fields.search3") || $request->input("fields.soluong3") || $request->input("fields.type_soluong3") || $request->input("fields.chon_1ngay3") || $request->input("fields.moilan3") ){
            $a =[
                'search3'       => 'required',
                'soluong3'      => 'required',
                'type_soluong3' => 'required',
                'chon_1ngay3'   => 'required',
                'moilan3'       => 'required',
                'uongbuoi3'     => 'required',
            ];
            $rules = array_merge($rules,$a);
        }
        if($request->input("uongbuoi4")){
            $a =[
                'search4'       => 'required',
                'soluong4'      => 'required',
                'type_soluong4' => 'required',
                'chon_1ngay4'   => 'required',
                'moilan4'       => 'required',
            ];
            $rules = array_merge($rules,$a);
        }
        else if($request->input("fields.search4") || $request->input("fields.soluong4") || $request->input("fields.type_soluong4") || $request->input("fields.chon_1ngay4") || $request->input("fields.moilan4") ){
            $a =[
                'search4'       => 'required',
                'soluong4'      => 'required',
                'type_soluong4' => 'required',
                'chon_1ngay4'   => 'required',
                'moilan4'       => 'required',
                'uongbuoi4'     => 'required',
            ];
            $rules = array_merge($rules,$a);
        }
        if($request->input("uongbuoi5")){
            $a =[
                'search5'       => 'required',
                'soluong5'      => 'required',
                'type_soluong5' => 'required',
                'chon_1ngay5'   => 'required',
                'moilan5'       => 'required',
            ];
            $rules = array_merge($rules,$a);
        }
        else if($request->input("fields.search5") || $request->input("fields.soluong5") || $request->input("fields.type_soluong5") || $request->input("fields.chon_1ngay5") || $request->input("fields.moilan5") ){
            $a =[
                'search5'       => 'required',
                'soluong5'      => 'required',
                'type_soluong5' => 'required',
                'chon_1ngay5'   => 'required',
                'moilan5'       => 'required',
                'uongbuoi5'     => 'required',
            ];
            $rules = array_merge($rules,$a);
        }
        
        if($request->input("uongbuoi6")){
            $a =[
                'search6'       => 'required',
                'soluong6'      => 'required',
                'type_soluong6' => 'required',
                'chon_1ngay6'   => 'required',
                'moilan6'       => 'required',
            ];
            $rules = array_merge($rules,$a);
        }
        else if($request->input("fields.search6") || $request->input("fields.soluong6") || $request->input("fields.type_soluong6") || $request->input("fields.chon_1ngay6") || $request->input("fields.moilan6") ){
            $a =[
                'search6'       => 'required',
                'soluong6'      => 'required',
                'type_soluong6' => 'required',
                'chon_1ngay6'   => 'required',
                'moilan6'       => 'required',
                'uongbuoi6'     => 'required',
            ];
            $rules = array_merge($rules,$a);
        }
        $v = Validator::make($request->fields, $rules,$messages);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }
        else{
            $id_layso = $request->iddk;
            $checkidLayso = DB::table('toathuoc')
                ->where('phieukham_id',$id_layso)
                ->get();
            $demKq = count($checkidLayso);
            if($demKq == 0){
                $a=Auth::id();
                //id_layso duy nhất trong bảng khám bệnh
                $id_phongkham = DB::table('phongkham')
                    ->where('user_id', $a)
                    ->value('id');

                $datimeNow = Carbon::now('Asia/Ho_Chi_Minh');
                $khambenh_id = Toathuoc::insertGetId([
                    'phieukham_id'   => $id_layso , 
                    'chuandoan'        => $request->input("fields.chuandoan") ,
                    'loidan'           => $request->input("fields.loidan") ,
                    'taikham'           => $request->input("fields.taikham") ,
                    'thoigiandt'       => $datimeNow ,

                ]);

                if($request->input("fields.search1")){
                    $buoi1 = $request->uongbuoi1;
                    //Chuyển mảng thành chuỗi
                    $implode1 = implode(', ',$buoi1);
                    //In hoa kí tự đầu tiên
                    $implode1 = ucfirst($implode1);
                    //echo $implode1;
                    Chitietthuoc::create([
                        'tenthuoc'      => $request->input("fields.search1"),
                        'soluong'       => $request->input("fields.soluong1"),
                        'toathuoc_id'   => $khambenh_id,
                        'dangthuoc'     => $request->input("fields.type_soluong1"),
                        'moingay'       => $request->input("fields.chon_1ngay1"),
                        'moilan'        => $request->input("fields.moilan1"),
                        'buoi'          => $implode1,
                    ]);
                }
                if($request->input("fields.search2")){
                    $buoi2 = $request->uongbuoi2;
                    //Chuyển mảng thành chuỗi
                    $implode2 = implode(', ',$buoi2);
                    //In hoa kí tự đầu tiên
                    $implode2 = ucfirst($implode2);
                    //echo $implode1;
                    Chitietthuoc::create([
                        'tenthuoc'      => $request->input("fields.search2"),
                        'soluong'       => $request->input("fields.soluong2"),
                        'toathuoc_id'   => $khambenh_id,
                        'dangthuoc'     => $request->input("fields.type_soluong2"),
                        'moingay'       => $request->input("fields.chon_1ngay2"),
                        'moilan'        => $request->input("fields.moilan2"),
                        'buoi'          => $implode2,
                    ]);
                }
                if($request->input("fields.search3")){
                    $buoi3 = $request->uongbuoi3;
                    //Chuyển mảng thành chuỗi
                    $implode3 = implode(', ',$buoi3);
                    //In hoa kí tự đầu tiên
                    $implode3 = ucfirst($implode3);
                    //echo $implode1;
                    Chitietthuoc::create([
                        'tenthuoc'      => $request->input("fields.search3"),
                        'soluong'       => $request->input("fields.soluong3"),
                        'toathuoc_id'   => $khambenh_id,
                        'dangthuoc'     => $request->input("fields.type_soluong3"),
                        'moingay'       => $request->input("fields.chon_1ngay3"),
                        'moilan'        => $request->input("fields.moilan3"),
                        'buoi'          => $implode3,
                    ]);
                }
                if($request->input("fields.search4")){
                    $buoi4 = $request->uongbuoi4;
                    //Chuyển mảng thành chuỗi
                    $implode4 = implode(', ',$buoi4);
                    //In hoa kí tự đầu tiên
                    $implode4 = ucfirst($implode4);
                    //echo $implode1;
                    Chitietthuoc::create([
                        'tenthuoc'      => $request->input("fields.search4"),
                        'soluong'       => $request->input("fields.soluong4"),
                        'toathuoc_id'   => $khambenh_id,
                        'dangthuoc'     => $request->input("fields.type_soluong4"),
                        'moingay'       => $request->input("fields.chon_1ngay4"),
                        'moilan'        => $request->input("fields.moilan4"),
                        'buoi'          => $implode4,
                    ]);
                }
                if($request->input("fields.search5")){
                    $buoi5 = $request->uongbuoi5;
                    //Chuyển mảng thành chuỗi
                    $implode5 = implode(', ',$buoi5);
                    //In hoa kí tự đầu tiên
                    $implode5 = ucfirst($implode5);
                    //echo $implode1;
                    Chitietthuoc::create([
                        'tenthuoc'      => $request->input("fields.search5"),
                        'soluong'       => $request->input("fields.soluong5"),
                        'toathuoc_id'   => $khambenh_id,
                        'dangthuoc'     => $request->input("fields.type_soluong5"),
                        'moingay'       => $request->input("fields.chon_1ngay5"),
                        'moilan'        => $request->input("fields.moilan5"),
                        'buoi'          => $implode5,
                    ]);
                }
                if($request->input("fields.search6")){
                    $buoi6 = $request->uongbuoi6;
                    //Chuyển mảng thành chuỗi
                    $implode6 = implode(', ',$buoi6);
                    //In hoa kí tự đầu tiên
                    $implode6 = ucfirst($implode6);
                    //echo $implode1;
                    Chitietthuoc::create([
                        'tenthuoc'      => $request->input("fields.search6"),
                        'soluong'       => $request->input("fields.soluong6"),
                        'toathuoc_id'   => $khambenh_id,
                        'dangthuoc'     => $request->input("fields.type_soluong6"),
                        'moingay'       => $request->input("fields.chon_1ngay6"),
                        'moilan'        => $request->input("fields.moilan6"),
                        'buoi'          => $implode6,
                    ]);
                }

                return response()->json(['status' =>"Ok"]);
            }else{
                // return redirect()->back()->with('alert', 'Đã lưu kết quả');
                return response()->json(['status' =>"Saved"]);
            }
        }
    }

    public function checkLuu(Request $request){
        $iddk = $request->iddk;
        $db = DB::table("toathuoc")
            ->where("phieukham_id", $iddk)
            ->get();
        $count = count($db);
        if($count == 1){
            return response()->json(['ketquaCheck'=>"Daluu"]);
        }else{
            return response()->json(['ketquaCheck'=>"Chualuu"]);
        }
    }
    public function lichsukhambenh(Request $request){
        $id_dangkylayso = $request->iddk;
        $id_BenhNhan = DB::table('phieukham')
            ->where('id', $id_dangkylayso)
            ->value('benhnhan_id');
        $history_BN = DB::table('toathuoc')
            ->select('toathuoc.id','tencs','diachi','sodtpk','tenck','thoigiandt','sokb','chuandoan','loidan', 'taikham')
            ->join('phieukham', 'toathuoc.phieukham_id', '=', 'phieukham.id')
            ->join('phongkham', 'phieukham.phongkham_id', '=', 'phongkham.id')
            ->join('chuyenkhoa', 'phongkham.chuyenkhoa_id', '=', 'chuyenkhoa.id')
            ->where('benhnhan_id', $id_BenhNhan)
            ->orderBy('toathuoc.thoigiandt', 'desc')
            ->get();
        $list_chuyenkhoa = DB::table('toathuoc')
            ->select('chuyenkhoa.id','tenck')
            ->distinct()
            ->join('phieukham', 'toathuoc.phieukham_id', '=', 'phieukham.id')
            ->join('phongkham', 'phieukham.phongkham_id', '=', 'phongkham.id')
            ->join('chuyenkhoa', 'phongkham.chuyenkhoa_id', '=', 'chuyenkhoa.id')
            ->where('benhnhan_id', $id_BenhNhan)
            ->get();
        $thuoc = DB::table('chitietthuoc')
            ->get();    
        $res =[
            'history_BN'        => $history_BN,
            'thuoc'             => $thuoc,
            'list_chuyenkhoa'   => $list_chuyenkhoa,
        ];
        return response()->json($res);
    }
    public function locLichsukhambenh(Request $request){
        $id_dangkylayso = $request->iddk;
        $id_chuyenkhoa = $request->id_chuyenkhoa;
        $id_BenhNhan = DB::table('phieukham')
            ->where('id', $id_dangkylayso)
            ->value('benhnhan_id');
        $history_BN = DB::table('toathuoc')
            ->select('toathuoc.id','tencs','diachi','sodtpk','tenck','thoigiandt','sokb','chuandoan','loidan', 'taikham')
            ->join('phieukham', 'toathuoc.phieukham_id', '=', 'phieukham.id')
            ->join('phongkham', 'phieukham.phongkham_id', '=', 'phongkham.id')
            ->join('chuyenkhoa', 'phongkham.chuyenkhoa_id', '=', 'chuyenkhoa.id')
            // Lọc theo chuyên khoa
            ->where('chuyenkhoa.id', $id_chuyenkhoa)
            ->where('benhnhan_id', $id_BenhNhan)
            ->orderBy('toathuoc.thoigiandt', 'desc')
            ->get();
        $list_chuyenkhoa = DB::table('toathuoc')->select('chuyenkhoa.id','tenck')
            ->distinct()
            ->join('phieukham', 'toathuoc.phieukham_id', '=', 'phieukham.id')
            ->join('phongkham', 'phieukham.phongkham_id', '=', 'phongkham.id')
            ->join('chuyenkhoa', 'phongkham.chuyenkhoa_id', '=', 'chuyenkhoa.id')
            ->where('benhnhan_id', $id_BenhNhan)
            ->get();
        $thuoc = DB::table('chitietthuoc')
            ->get();   
        $res =[
            'history_BN'        => $history_BN,
            'thuoc'             => $thuoc,
            'list_chuyenkhoa'   => $list_chuyenkhoa,
        ];
        return response()->json($res);
    }
    public function luutin(Request $request){
        $v = Validator::make($request->all(), [
            'tieude'         => 'required',
            'noidung'        => 'required',
            ],
            [
            'tieude.required'        => 'Trường bắt buộc(*)',
            'noidung.required'       => 'Trường bắt buộc(*)',
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
            $a=Auth::id();
            $checkExist = DB::table('phongkham')
                ->where('user_id', $a)
                ->get();
            $countE = count($checkExist);
            $id_phongkham = DB::table('phongkham')
                ->where('user_id', $a)
                ->value('id');
            
            if($countE != 0 ){
                $datimeNow = Carbon::now('Asia/Ho_Chi_Minh');
                Bangtin::create([
                    'phongkham_id'  => $id_phongkham , 
                    'tieude'        => $request->tieude ,
                    'noidung'       => $request->noidung , 
                    'thoigian'      => $datimeNow ,
                ]);
                return response()->json(['status'=> 'luuthanhcong']);
            }
            else{
                return response()->json(['status'=> 'phongkhamchuacoTT']);
            }

        }
    }
    public function tintuc(){
        $a=Auth::id();
        $news = DB::table('bangtin')
            ->join('phongkham', 'phongkham.id', '=', 'bangtin.phongkham_id')
            ->where('phongkham.user_id', $a)
            ->orderBy('thoigian', 'desc')
            ->get();
        $count = count($news);
        $res =[
            'news'  => $news,
            'count' => $count
        ];
        return response()->json($res);
    }

    public function tenPhongkham(){
        $a=Auth::id();
        $db = DB::table("phongkham")
            ->select('tencs')
            ->where("user_id", $a)
            ->get();
        $count = count($db);
        return response()->json(['tenpk' => $db, 'count' => $count]);
    }
}
