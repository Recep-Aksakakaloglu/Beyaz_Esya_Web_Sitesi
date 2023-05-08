<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use App\Models\Models\Kategori;
use App\Models\Models\Siparis;
use App\Models\Models\Urun;
use App\Models\Models\UrunDetay;
use Illuminate\Http\Request;

class SiparisController extends Controller
{
    public function index(){
        \request()->flash();
        if(request()->filled('aranan')){
            $aranan = \request('aranan');
            $list = Siparis::where('adsoyad','like','%$aranan%')->orWhere('banka','like','%$aranan%')->paginate(8);
        }else {
            $list = Siparis::with('sepet.kullanici')->paginate(8);
        }
        return view('yonetim.siparis.index',compact('list'));
    }
    public function form($id = 0){

        if($id>0){
            $entry = Siparis::with('sepet.sepet_urunler.urun')->find($id);
        }

        return view('yonetim.siparis.form',compact('entry'));
    }
    public function kaydet($id = 0){
        $this->validate(\request(),[
            'adsoyad'=>'required',
            'adres'=>'required',
            'telefon'=>'required',
            'durum'=>'required'
        ]);

        $data = \request()->only('adsoyad','adres','telefon','ceptelefonu','durum');

        if($id>0){
            $entry = Siparis::where('id',$id)->firstOrFail();
            $entry->update($data);
        }

        return redirect()->route('yonetim.siparis.duzenle',$entry->id)->with('mesaj','Guncellendi')
            ->with('mesaj_tur','success');
    }
    public function sil($id){

        Siparis::destroy($id);

        return redirect()->route('yonetim.siparis')->with('mesaj','Kayıt Silindi')->with('mesaj_tur','success');
    }
}
