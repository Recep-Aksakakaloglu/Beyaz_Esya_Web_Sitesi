<?php

namespace Database\Seeders;

use App\Models\Models\Kullanici;
use App\Models\Models\KullaniciDetay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KullaniciSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Kullanici::trucate();
        KullaniciDetay::truncate();

        $faker = \Faker\Factory::create([
            'adsoyad'=>'Recep Aksakaloğlu',
            'email'=>'recep.aksakaloglu@gmail.com',
            'sifre'=>bcrypt('12345'),
            'aktif_mi'=>1,
            'yonetici_mi'=>1
        ]);

        $faker->detay()->create([
           'adres'=>'Karabük',
           'telefon'=>'(545) 583 11 06',
           'ceptelefonu'=>'(545) 583 11 06',
        ]);
    }
}
