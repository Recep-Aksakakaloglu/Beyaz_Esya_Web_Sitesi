<?php

namespace App\Http\Controllers;

use App\Models\Models\Kategori;
use App\Models\Models\UrunDetay;
use App\Models\Models\Urun;
use Illuminate\Http\Request;

class AnasayfaController extends Controller
{
    public function index(){
        /*$isim = "Recep";
        $soyisim = "Aksakaloğlu";
        $isimler = ['Recep','Aksakaloğlu'];
        ];
        //return  view('anasayfa',['isim'=>'Cem', 'soyisim'=>'Gündüzoğlu']);
        return  view ('anasayfa',compact('isim','soyisim', 'isimler','kullanicilar'));
        //return view('anasayfa')->with(['isim'=>$isim,'soyisim'=>$soyisim]);*/


        $kategoriler = Kategori::whereRaw('ust_id is null')->take(8)->get();



        $urunler_slider = UrunDetay::with('urun')->where('goster_slider',1)->where('urun_adet','>',0)->take(4)->orderBy('updated_at','desc')->get();

        $urun_gunun_firsati = Urun::select('urun.*')->join('urun_detay','urun_detay.urun_id','urun.id')->where('urun_detay.goster_gunun_firsati',1)->
        where('urun_detay.urun_adet','>',0)->
        orderBy('updated_at','desc')->first();

        $urunler_one_cikan = UrunDetay::with('urun')->where('goster_one_cikan',1)->where('urun_adet','>',0)->orderBy('updated_at','desc')->take(4)->get();
        $urunler_cok_satan = UrunDetay::with('urun')->where('goster_cok_satan',1)->where('urun_adet','>',0)->orderBy('updated_at','desc')->take(4)->get();
        $urunler_indirimli = UrunDetay::with('urun')->where('goster_indirimli',1)->where('urun_adet','>',0)->orderBy('updated_at','desc')->take(4)->get();

        return view('anasayfa',compact('kategoriler','urunler_slider','urun_gunun_firsati','urunler_one_cikan','urunler_cok_satan','urunler_indirimli'));
    }
}
