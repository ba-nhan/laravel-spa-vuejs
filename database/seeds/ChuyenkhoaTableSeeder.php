<?php

use Illuminate\Database\Seeder;

class ChuyenkhoaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chuyenkhoa')->insert([
            ['tenck' => 'Tai - Mũi - Họng'],
            ['tenck' => 'Răng - Hàm - Mặt'],
            ['tenck' => 'Mắt'],
            ['tenck' => 'Da liễu'],
            ['tenck' => 'Nhi'],
            ['tenck' => 'Sản'],
            ['tenck' => 'Tim mạch'],
            ['tenck' => 'Thần kinh'],
            ['tenck' => 'Nội tiết'],
            ['tenck' => 'Nha'],
            ['tenck' => 'Ngoại tiết niệu'],
            ['tenck' => 'Ngoại chấn thương'],
            ['tenck' => 'Hô hấp'],
            ['tenck' => 'Sản phụ khoa'],
            ['tenck' => 'Chuẩn đoán hình ảnh'],
            ['tenck' => 'Xét nghiệm'],
            ['tenck' => 'Nội tổng quát'],
            ['tenck' => 'Tâm lý'],
            ['tenck' => 'Vật lý trị liệu'],
            ['tenck' => 'Ung bướu'],
            ['tenck' => 'Thẩm mỹ'],
            ['tenck' => 'Nội'],
            ['tenck' => 'Y học cổ truyền'],
            ['tenck' => 'Ngoại'],
            ['tenck' => 'Phụ sản'],
            ['tenck' => 'Nội thần kinh'],
            ['tenck' => 'Lao và bệnh phổi'],
            ['tenck' => 'Ung bướu'],
            ['tenck' => 'Nội tim mạch'],
            ['tenck' => 'Nội tổng hợp'],
            ['tenck' => 'Siêu âm'],
            ['tenck' => 'Điều dưỡng']
        ]);
    }
}
