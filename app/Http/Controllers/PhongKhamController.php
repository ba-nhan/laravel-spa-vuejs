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
use App\Chitietthuoc;
use App\Thuoc;

class PhongKhamController extends Controller
{
    public function hoso(Request $request){
        $id=$request->idpk;
        //Thông tin phòng khám
        $info = DB::table('phongkham')
            ->select('tencs','ngaycp','tenbs','nsbs','gioitinhbs','trinhdo','tenck', 'name','diachi','sodtpk', 'timetb', 'iframe_map',  'layout')
            ->join('trinhdo', 'phongkham.trinhdo_id', '=', 'trinhdo.id')
            ->join('chuyenkhoa', 'phongkham.chuyenkhoa_id', '=', 'chuyenkhoa.id')
            ->join('noicongtac', 'phongkham.noicongtac_id', '=', 'noicongtac.id')
            ->where('phongkham.id', $id)
            ->get();
        // ID khung thời gian của từng phòng khám
        $id_frame1 = DB::table('phongkham')
            ->join('khungthoigian', 'phongkham.khung1_id', '=', 'khungthoigian.id')
            ->where('phongkham.id', $id)
            ->value('khungthoigian.id');
        $id_frame2 = DB::table('phongkham')
            ->join('khungthoigian', 'phongkham.khung2_id', '=', 'khungthoigian.id')
            ->where('phongkham.id', $id)
            ->value('khungthoigian.id');
        $id_frame3 = DB::table('phongkham')
            ->join('khungthoigian', 'phongkham.khung3_id', '=', 'khungthoigian.id')
            ->where('phongkham.id', $id)
            ->value('khungthoigian.id');
        //Thời gian bắt đầu và kết thúc của từng khung vừa tìm
        $time_s1 = DB::table('phongkham')
            ->join('khungthoigian', 'phongkham.khung1_id', '=', 'khungthoigian.id')
            ->where('phongkham.id', $id)
            ->value('timestart');
        $time_e1 = DB::table('phongkham')
            ->join('khungthoigian', 'phongkham.khung1_id', '=', 'khungthoigian.id')
            ->where('phongkham.id', $id)
            ->value('timeend');
        $time_s2 = DB::table('phongkham')
            ->join('khungthoigian', 'phongkham.khung2_id', '=', 'khungthoigian.id')
            ->where('phongkham.id', $id)
            ->value('timestart');
        $time_e2 = DB::table('phongkham')
            ->join('khungthoigian', 'phongkham.khung2_id', '=', 'khungthoigian.id')
            ->where('phongkham.id', $id)
            ->value('timeend');
        $time_s3 = DB::table('phongkham')
            ->join('khungthoigian', 'phongkham.khung3_id', '=', 'khungthoigian.id')
            ->where('phongkham.id', $id)
            ->value('timestart');
        $time_e3 = DB::table('phongkham')
            ->join('khungthoigian', 'phongkham.khung3_id', '=', 'khungthoigian.id')
            ->where('phongkham.id', $id)
            ->value('timeend');
        //Định dạng lại thời gian
        $time_s1 = date ('H:i',strtotime($time_s1));
        $time_e1 = date ('H:i',strtotime($time_e1));
        $time_s2 = date ('H:i',strtotime($time_s2));
        $time_e2 = date ('H:i',strtotime($time_e2));
        $time_s3 = date ('H:i',strtotime($time_s3));
        $time_e3 = date ('H:i',strtotime($time_e3));

        //Cách thức hoạt động của số kb
        $e = Carbon::now('Asia/Ho_Chi_Minh');
        //Thời gian hiện tại
        $timenow = $e->toTimeString();
        //Ngày hiện tại
        $datenow = $e->toDateString();
        $sokb_frame1 = DB::table("phieukham")
            ->where("phongkham_id",$id)
            ->whereDate('thoigian', $datenow)
            ->where("khungtime_id",$id_frame1)
            ->max('sokb');
            //Số tiếp theo số lớn nhất
        $sokb_frame1 = $sokb_frame1 + 1;

        $sokb_frame2 = DB::table("phieukham")
            ->where("phongkham_id",$id)
            ->whereDate('thoigian', $datenow)
            ->where("khungtime_id",$id_frame2)
            ->max('sokb');
            //Số tiếp theo số lớn nhất
        $sokb_frame2 = $sokb_frame2 + 1;

        $sokb_frame3 = DB::table("phieukham")
            ->where("phongkham_id",$id)
            ->whereDate('thoigian', $datenow)
            ->where("khungtime_id",$id_frame3)
            ->max('sokb');
            //Số tiếp theo số lớn nhất
        $sokb_frame3 = $sokb_frame3 + 1;


        return response()->json([
            'info'          => $info, 
            'time_s1'       => $time_s1, 
            'time_e1'       => $time_e1, 
            'time_s2'       => $time_s2, 
            'time_e2'       => $time_e2, 
            'time_s3'       => $time_s3, 
            'time_e3'       => $time_e3, 
            'id_frame1'     => $id_frame1, 
            'id_frame2'     => $id_frame2,
            'id_frame3'     => $id_frame3,
            'sokb_frame1'   => $sokb_frame1,
            'sokb_frame2'   => $sokb_frame2, 
            'sokb_frame3'   => $sokb_frame3,  
        ]);
    }
    public function list_chuyenkhoa(){
        $ds_chuyenkhoa = DB::table("chuyenkhoa")
            ->select("chuyenkhoa.id","tenck")
            ->distinct()
            ->join("phongkham", "phongkham.chuyenkhoa_id", "=", "chuyenkhoa.id")
            ->get();
        return response()->json($ds_chuyenkhoa);
    }
    public function bangtin(Request $request){
        $idpk = $request->idpk;
        $news = DB::table('bangtin')
            ->join('phongkham', 'phongkham.id', '=', 'bangtin.phongkham_id')
            ->where('phongkham.id', $idpk)
            ->orderBy('thoigian', 'desc')
            ->get();
        $count = count($news);
        $res =[
            'news'  => $news,
            'count' => $count
        ];
        return response()->json($res);
    }
    public function phongkham(){
        $db = DB::table("phongkham")
            ->select("tencs", "tenck", "vido", "kinhdo")
            ->join("chuyenkhoa", "phongkham.chuyenkhoa_id", "=", "chuyenkhoa.id")
            ->get();
        return response()->json($db);
    }
}
