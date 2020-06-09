<?php

use Illuminate\Database\Seeder;

class NoicongtacTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('noicongtac')->insert([
            ['name' => 'BVĐKTT An Giang', 'tinh_id'=> '1'],
            ['name' => 'BVĐK Châu Đốc', 'tinh_id'=> '1'],
            ['name' => 'BVĐK Nhật Tân', 'tinh_id'=> '1'],
            ['name' => 'BVĐK Tân Châu', 'tinh_id'=> '1'],
            ['name' => 'BVĐK TP. Long Xuyên', 'tinh_id'=> '1'],
            ['name' => 'Bệnh viện Tim mạch An Giang ', 'tinh_id'=> '1'],
            ['name' => 'Bệnh viện Mắt - Tai Mũi Họng - Răng Hàm Mặt An Giang', 'tinh_id'=> '1'],
            ['name' => 'Nha khoa Sài Gòn', 'tinh_id'=> '1'],
            ['name' => 'Thẩm mỹ viện Ngọc Hường', 'tinh_id'=> '1'],
            ['name' => 'Nghĩ hưu', 'tinh_id'=> '1'],
            ['name' => 'Nghĩ việc', 'tinh_id'=> '1'],
            ['name' => 'Bệnh viện Công an thành phố Cần Thơ', 'tinh_id'=> '2'],
            ['name' => 'Bệnh viện Da liễu', 'tinh_id'=> '2'],
            ['name' => 'Bệnh viện Đa khoa Hòa Hảo – Medic Cần Thơ', 'tinh_id'=> '2'],
            ['name' => 'Bệnh viện Đa khoa Thốt Nốt', 'tinh_id'=> '2'],
            ['name' => 'Bệnh viện Đa khoa Trung ương Cần Thơ', 'tinh_id'=> '2'],
            ['name' => 'Bệnh viện Đa khoa Cần Thơ', 'tinh_id'=> '2'],
            ['name' => 'Bệnh viện Đa khoa Hoàn Mỹ Cửu Long', 'tinh_id'=> '2'],
            ['name' => 'Bệnh viện Huyết học - Truyền máu', 'tinh_id'=> '2'],
            ['name' => 'Bệnh viện Nhi đồng ', 'tinh_id'=> '2'],
            ['name' => 'Bệnh viện Mắt - Răng Hàm Mặt', 'tinh_id'=> '2'],
            ['name' => 'Bệnh viện Trường Đại học Y Dược Cần Thơ', 'tinh_id'=> '2'],
            ['name' => 'Bệnh viện Tim mạch', 'tinh_id'=> '2'],
            ['name' => 'Bệnh viện Quân y 121', 'tinh_id'=> '2'],
            ['name' => 'Bệnh viện Quốc tế Phương Châu', 'tinh_id'=> '2'],
            ['name' => 'Bệnh viện Ung bướu', 'tinh_id'=> '2'],
            ['name' => 'Bệnh viện Phụ sản', 'tinh_id'=> '2'],
            ['name' => 'Bệnh viện Y học cổ truyền', 'tinh_id'=> '2'],
            ['name' => 'Bệnh viện Lao & Phổi', 'tinh_id'=> '2'],
            ['name' => 'Bệnh viện Mắt Sài Gòn - Cần Thơ', 'tinh_id'=> '2'],
            ['name' => 'Phòng khám đa khoa Hoàn Hảo', 'tinh_id'=> '2'],
            ['name' => 'Phòng khám đa khoa Vạn Phước Cửu Long', 'tinh_id'=> '2'],
            ['name' => 'Thẩm mỹ viện Ngọc Dung - Cơ sở Cần Thơ', 'tinh_id'=> '2'],
            ['name' => 'Trung tâm Chỉnh hình và Phục hồi chức năng Cần Thơ', 'tinh_id'=> '2'],
            ['name' => 'Trung tâm Y tế dự phòng Cần Thơ', 'tinh_id'=> '2'],
            ['name' => 'Nghĩ hưu', 'tinh_id'=> '2'],
            ['name' => 'Nghĩ việc', 'tinh_id'=> '2'],
            ['name' => 'Phòng y tế Bình Thủy', 'tinh_id'=> '2'],
            ['name' => 'Trường Đại học Y dược', 'tinh_id'=> '2'],
            ['name' => 'Trường cao đẳng Y tế Cần Thơ', 'tinh_id'=> '2'],
            ['name' => 'Trung tâm Pháp y', 'tinh_id'=> '2'],
            ['name' => 'Trạm y tế Bùi Hữu Nghĩa', 'tinh_id'=> '2'],
            ['name' => 'Trường Trung cấp Phạm Ngọc Thạch', 'tinh_id'=> '2'],
        ]);
    }
}
