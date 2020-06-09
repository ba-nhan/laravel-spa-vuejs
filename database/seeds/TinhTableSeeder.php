<?php

use Illuminate\Database\Seeder;

class TinhTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tinh')->insert([
            ['name' => 'An Giang'],
            ['name' => 'TP. Cần Thơ']
        ]);
    }
}
