<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(ChuyenkhoaTableSeeder::class);
        $this->call(TrinhdoTableSeeder::class);
        $this->call(TinhTableSeeder::class);
        $this->call(NoicongtacTableSeeder::class);
        $this->call(DanhsachthuocTableSeeder::class);
    }
}
