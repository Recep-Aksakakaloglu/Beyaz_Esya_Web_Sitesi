<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use App\Models\Models\Kullanici;
use App\Models\Models\Siparis;
use App\Models\Models\Urun;
use Illuminate\Http\Request;

class AnasayfaController extends Controller
{
    public function index(){

        $bekleyen_siparis = Siparis::where('durum','Siparişiniz alındı')->count();
        $onaylı_siparis = Siparis::where('durum','Ödeme Onaylandı')->count();
        $kargoya_verilen = Siparis::where('durum','Kargoya verildi')->count();
        $tamamlanan_siparis = Siparis::where('durum','Sipariş tamamlandı')->count();
        $toplam_urun = Urun::count();
        $satilan_urun=Siparis::count();
        $musteri = Kullanici::count();
        $admin = Kullanici::where('yonetici_mi',1)->count();

        return view('yonetim.anasayfa',compact('bekleyen_siparis','onaylı_siparis','kargoya_verilen',
                                                            'tamamlanan_siparis','toplam_urun','musteri','admin',
                                                            'satilan_urun'));
    }
}
