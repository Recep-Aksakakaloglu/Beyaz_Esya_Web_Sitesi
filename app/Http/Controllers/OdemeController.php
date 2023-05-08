<?php

namespace App\Http\Controllers;

use App\Models\Models\SepetUrun;
use App\Models\Models\Siparis;
use App\Models\Models\Sepet;
use App\Models\Models\UrunDetay;
use App\Models\Urun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OdemeController extends Controller
{
    public function index(){
        if(!auth()->check()){
            return redirect()->route('kullanici.oturumac')->with('mesaj_tur','info')->with('mesaj','Ödeme işlemi için oturum açın');
        }

        $sepet = Sepet::where('kullanici_id',auth()->id())->orderByDesc('created_at')->firstOrFail();

        $siparis2 = Siparis::where('sepet_id',$sepet->id)->orderByDesc('created_at')->get();

        $kullanici_detay = auth()->user()->detay;
        return view('odeme',compact('kullanici_detay','siparis2'));

    }

    public function odemeyap(){
        $siparis = request()->all();
        $siparis['sepet_id'] = session('aktif_sepet_id');
        $siparis['banka'] = "Garanti";
        //$siparis['taksit_sayisi']=1;
        $siparis['durum']="Siparişiniz Alındı";

        $sepet = Sepet::where('kullanici_id',auth()->id())->orderByDesc('created_at')->firstOrFail();
        $tutar = SepetUrun::where('sepet_id',$sepet->id)->orderByDesc('created_at')->firstOrFail();
        $urundetay = UrunDetay::where('urun_id',$tutar->urun_id)->firstOrFail();

        $siparis['siparis_tutari'] = $tutar->tutar;

            Siparis::create($siparis);
            session()->forget('aktif_sepet_id');

            $urun_detay = UrunDetay::where('urun_id',$tutar->urun_id)->update(['urun_adet'=>($urundetay->urun_adet-1)]);

        return redirect()->route('siparisler')->with('mesaj_tur','success')->with('mesaj','Ödemeneniz Alındı');
    }
}
