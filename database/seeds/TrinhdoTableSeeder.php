<?php

use Illuminate\Database\Seeder;

class TrinhdoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trinhdo')->insert([
            ['trinhdo' => 'BSĐK'],
            ['trinhdo' => 'BSCK1'],
            ['trinhdo' => 'BSCK1 Nội'],
            ['trinhdo' => 'BSCK1 Ngoại'],
            ['trinhdo' => 'BSCK1 Chuẩn đoán hình ảnh'],
            ['trinhdo' => 'BSCK1 Mắt'],
            ['trinhdo' => 'BSCK1 Nhi'],
            ['trinhdo' => 'BSCK1 Phụ sản'],
            ['trinhdo' => 'BSCK1 Nội thần Kinh'],
            ['trinhdo' => 'BSCK1 Tai mũi họng'],
            ['trinhdo' => 'BSCK1 Lao'],
            ['trinhdo' => 'BSCK2'],
            ['trinhdo' => 'BSCK2 Gây mê hồi sức'],
            ['trinhdo' => 'BSCK2 Ung bướu'],
            ['trinhdo' => 'BSCK2 Nội'],
            ['trinhdo' => 'BSCK2 Ngoại'],
            ['trinhdo' => 'BS Sản phụ khoa'],
            ['trinhdo' => 'Điều dưỡng'],
            ['trinhdo' => 'Giảng viên y dược'],
            ['trinhdo' => 'Lương y đa khoa'],
            ['trinhdo' => 'Lương y'],
            ['trinhdo' => 'Y sĩ YHCT'],
            ['trinhdo' => 'Y tá'],
            ['trinhdo' => 'Hộ sinh'],
            ['trinhdo' => 'Nha công'],
            ['trinhdo' => 'Phụ sản'],
            ['trinhdo' => 'Điều dưỡng'],
            ['trinhdo' => 'Chuyên ngành xét nghiệm'],
            ['trinhdo' => 'Vật lý trị liệu'],
        ]);
    }
}
