<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\Phieukham;
use Validator;

class LaysoController extends Controller
{
    public function dangky(Request $req){
    	$a = Auth::id();
    	$c = $req->idpk;
    	$d = $req->sokb;
    	$id_frame = $req->idkhung;
    	$e = Carbon::now('Asia/Ho_Chi_Minh');
    	//Thời gian hiện tại
        $timenow = $e->toTimeString();

		$b = DB::table('benhnhan')->where('user_id',$a)->value('id');
		//Kiểm tra đã đăng nhập chưa
		if($a == null){
			return response()->json(['id_benhnhan' => $a]);

		}
		else{
			$checkBN = DB::table('benhnhan')
	            ->join('users', 'benhnhan.user_id', '=', 'users.id')
	            ->where('user_id', $a)
	            ->get();
        	$countBN = count($checkBN);
			// Bệnh nhân đã đăng kí thông tin chưa
        	if($countBN == 0){
	            return response()->json(['checkThongtinU' => 'unexist']);

	        }
	        else{
	        	//Ngày hiện tại
	            $datenow = $e->toDateString();
	            $sql = DB::table('phieukham')->select('sokb')
	                ->where('benhnhan_id', $b)
	                ->where('phongkham_id', $c)
	                ->where('khungtime_id', $id_frame)
	                ->whereDate('thoigian', $datenow)
	                ->get();
	            $countSQL = count($sql);
	            //print($countSQL);
	            
	            //Lấy thời gian hết thúc của khung thời gian khám
	            $checkFrame = DB::table('khungthoigian')
	                ->where('id', $id_frame)
	                ->value('timeend');
	            //Thời gian đăng kí từ 0h -> timeend
                if($timenow <= $checkFrame){
                	//Kiểm tra bệnh nhân đã đăng kí khám bệnh chưa. 1 người tại 1 thời điểm chỉ được lấy 1 số
	                if($countSQL == 0){
	                    Phieukham::create([
	                        'thoigian'       => $e ,
	                        'phongkham_id'   => $c ,
	                        'benhnhan_id'    => $b ,
	                        'khungtime_id'   => $id_frame ,
	                        'sokb'           => $d ,
	                    ]);
	                    //Phản hồi đăng kí thành công
	                    return response()->json(['status' => 'success']);
	                }
	                else{
	                	// Phản hồi đã đăng ký lấy số rôi
	                    return response()->json(['checkDangki' => 'is']);
	                }
	            }
	            else{
	            	//Phản hồi đã qua khung thời gian khám
                    return response()->json(['checkQuakhung' => 'is', $checkFrame]);
	            }
	        }
		}
    }
    public function show_NumKB(Request $request){
    	$a = Auth::id();
		$b = DB::table('benhnhan')->where('user_id',$a)->value('id');
    	$c = $request->idpk;
    	$d = $request->sokb;
    	$id_frame = $request->idkhung;
    	$e = Carbon::now('Asia/Ho_Chi_Minh');
        $timenow = $e->toTimeString();
        $datenow = $e->toDateString();

    	$showNumber = DB::table('phieukham')
    		->select('tenbn', 'sokb', 'thoigian', 'tencs','diachi')
            ->join('benhnhan','phieukham.benhnhan_id', '=', 'benhnhan.id')
            ->join('phongkham','phieukham.phongkham_id', '=', 'PhongKham.id')
            ->join('khungthoigian', 'phieukham.khungtime_id', '=','khungthoigian.id')
            ->whereDate('thoigian', $datenow)
            ->where('phongkham_id', $c)
            ->where('khungtime_id', $id_frame)
            ->where('benhnhan_id', $b)
            ->get();
        $time_start = DB::table('khungthoigian')
            ->where('id', $id_frame)
            ->value('timestart');
        $time_end = DB::table('khungthoigian')
            ->where('id', $id_frame)
            ->value('timeend');

        //Định dạng lại thời gian
        $time_start = date ('H:i',strtotime($time_start));
        $time_end = date ('H:i',strtotime($time_end));

        //Thời gian dự kiến
        $NumKB = DB::table('phieukham')
            ->whereDate('thoigian', $datenow)
            ->where('phongkham_id', $c)
            ->where('benhnhan_id', $b)
            ->value('sokb');

        $timetb = DB::table("phongkham")
            ->where('id', $c)
            ->value('timetb');
        $timeStart = DB::table('phieukham')
            ->join('khungthoigian', 'phieukham.khungtime_id', '=', 'khungthoigian.id')
            ->where('khungtime_id', $id_frame)
            ->where('phongkham_id', $c)
            ->where('benhnhan_id', $b)
            ->value('timestart');
        $total = ($NumKB-1)*$timetb;
        $timeExpected = date ('H:i',strtotime($timeStart. ' + ' .$total. ' minutes'));
        // $css = DB::table('phongkham')
        //     ->join('layout', 'phongkham.layout_id', '=', 'layout.id')
        //     ->where('phongkham.id', $phongkham_id)
        //     ->get();
        $response = [
        	'showNumber' 	=> $showNumber,
        	'time_start' 	=> $time_start,
        	'time_end' 		=> $time_end,
        	'timetb' 		=> $timetb,
        	'timeExpected' 	=> $timeExpected,

        ];
        return response()->json($response);
    }
}
