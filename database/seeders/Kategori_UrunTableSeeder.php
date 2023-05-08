<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Kategori_UrunTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori_urun')->truncate();
        DB::table('kategori_urun')->insert(['kategori_id'=>'1','urun_id'=>'1']);
        DB::table('kategori_urun')->insert(['kategori_id'=>'1','urun_id'=>'2']);
        DB::table('kategori_urun')->insert(['kategori_id'=>'1','urun_id'=>'3']);
    }
}
