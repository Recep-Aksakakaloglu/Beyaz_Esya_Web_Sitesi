<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori')->truncate();
        $id = DB::table('kategori')->insertGetId(['kategori_adi'=>'Buzdolabi', 'slug'=>'buzdolabi']);
        DB::table('kategori')->insert(['kategori_adi'=>'No-Frost','slug'=>'no-frost', 'ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Gardrop Tipi','slug'=>'gardrop-tipi', 'ust_id'=>$id]);


        $id = DB::table('kategori')->insertGetId(['kategori_adi'=>'Camasir Makinesi', 'slug'=>'camasir-makinesi']);
        DB::table('kategori')->insertGetId(['kategori_adi'=>'Kurutmali', 'slug'=>'kurutmali', 'ust_id'=>$id]);
        DB::table('kategori')->insertGetId(['kategori_adi'=>'Kurutmasiz', 'slug'=>'kurutmasiz', 'ust_id'=>$id]);


        $id = DB::table('kategori')->insert(['kategori_adi'=>'Bulasik Makinesi', 'slug'=>'bulasik-makinesi']);
        DB::table('kategori')->insert(['kategori_adi'=>'Dort Programli', 'slug'=>'dort-programli','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Bes Programli', 'slug'=>'bes programli','ust_id'=>$id]);


        DB::table('kategori')->insert(['kategori_adi'=>'Utu', 'slug'=>'utu']);
        DB::table('kategori')->insert(['kategori_adi'=>'Kurutma Makinesi', 'slug'=>'kurutma-makinesi']);
        DB::table('kategori')->insert(['kategori_adi'=>'Televizyon', 'slug'=>'televizyon']);
        DB::table('kategori')->insert(['kategori_adi'=>'Airfryer', 'slug'=>'airfryer']);
        DB::table('kategori')->insert(['kategori_adi'=>'Set Üstü Ocak', 'slug'=>'set-ustu-ocak']);
        DB::table('kategori')->insert(['kategori_adi'=>'Derin Dondurucu', 'slug'=>'set-ustu-ocak']);
    }
}
