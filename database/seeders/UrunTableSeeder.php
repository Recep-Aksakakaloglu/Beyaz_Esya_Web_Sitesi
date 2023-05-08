<?php

namespace Database\Seeders;

use App\Models\Models\UrunDetay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Urun;

class UrunTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker\Generator $faker): void
    {
        $faker = \Faker\Factory::create();
        /*\DB::table("urun")->insert([
            'urun_adi' => Str::random(10),
            'fiyati'=>rand(10,99)/10
        ]);*/

        /*Urun::truncate();

        for($i =0; $i<30; $i++)
        {
            $urun_adi = $faker->sentence(2);
            Urun::create([
                'urun_adi'=>$urun_adi,
                'slug'=>str_slug($urun_adi),
                'aciklama'=>$faker->sentences(20),
                'fiyati'=>$faker->randomFloat(3,1,10)
            ]);
        }*/

        Urun::truncate();
        UrunDetay::truncate();

        for($i =0; $i<30; $i++) {
            $urun_adi = $faker->streetName;
            $urun = Urun::create([
                'urun_adi' => $urun_adi,
                'slug' => str_slug($urun_adi),
                'aciklama' => $faker->paragraph(20),
                'fiyati' => $faker->randomFloat(3, 1, 10)
            ]);

            $detay = $urun->detay()->create([
                'goster_slider'=>rand(0,1),
                'goster_gunun_firsati'=>rand(0,1),
                'goster_one_cikan'=>rand(0,1),
                'goster_cok_satan'=>rand(0,1),
                'goster_indirimli'=>rand(0,1)
            ]);
        }


        /*DB::table('urun')->truncate();*/
        /*DB::table('urun')->insert(['urun_adi'=>'454270 MB','slug'=>'454270-mb-buzdolabi','aciklama'=>'buzdolabi','fiyati'=>2.4]);
        DB::table('urun')->insert(['urun_adi'=>'274580 EDI','slug'=>'274580-edi-buzdolabi','aciklama'=>'buzdolabi','fiyati'=>2.4]);
        DB::table('urun')->insert(['urun_adi'=>'574561 EI','slug'=>'574561-ei-buzdolabi','aciklama'=>'buzdolabi','fiyati'=>2.4]);
        DB::table('urun')->insert(['urun_adi'=>'9100 M','slug'=>'9100-m-camasir-makinesi','aciklama'=>'camasir makinesi','fiyati'=>2.4]);
        DB::table('urun')->insert(['urun_adi'=>'10120 M','slug'=>'10120-m-camasir-makinesi','aciklama'=>'camasir makinesi','fiyati'=>2.4]);
        DB::table('urun')->insert(['urun_adi'=>'7100 M','slug'=>'7100-m-camasir-makinesi','aciklama'=>'camasir makinesi','fiyati'=>2.4]);*/


    }
}
