<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use App\Models\Models\Kategori;
use App\Models\Models\Urun;
use App\Models\Models\UrunDetay;
use Illuminate\Http\Request;

class UrunController extends Controller
{
    public function index(){
        \request()->flash();
        if(request()->filled('aranan')){
            $aranan = \request('aranan');
            $list = Urun::where('urun_adi','like','%$aranan%')->orWhere('aciklama','like','%$aranan%')->paginate(8);
        }else {
            $list = Urun::paginate(10);
        }
        return view('yonetim.urun.index',compact('list'));
    }
    public function form($id = 0){
        $entry = new Urun;
        $urun_kategorileri = [];

        if($id>0){
            $entry = Urun::find($id);
            $urun_kategorileri = $entry->kategoriler()->pluck('kategori_id')->all();
        }

        $kategoriler = Kategori::all();

        return view('yonetim.urun.form',compact('entry','kategoriler', 'urun_kategorileri'));
    }
    public function kaydet($id = 0){
        $this->validate(\request(),[
            'urun_adi'=>'required',
            'fiyati'=>'required'
        ]);

        $data = \request()->only('urun_adi','slug','aciklama','fiyati');
        if(\request()->filled('slug')){
            //$data['slug'] = Hash::make(\request('sifre'));
        }
        $data_detay = \request()->only('goster_slider','goster_gunun_firsati','goster_one_cikan','goster_cok_satan','goster_indirimli','urun_adet');

        $kategoriler = \request('kategoriler');

        if($id>0){
            $entry = Urun::where('id',$id)->firstOrFail();
            $entry->update($data);

            $entry->detay()->update($data_detay);

            $entry->kategoriler()->sync($kategoriler);

        }else{
            $entry = Urun::create($data);
            $entry->detay()->create($data_detay);
            $entry->kategoriler()->attach($kategoriler);
        }

        if(\request()->hasFile('urun_resmi')){
            $this->validate(\request(),[
               'urun_resmi'=>'image|mimes:jpg,png,jpeg,gif|max:2048'
            ]);
            $urun_resmi = \request()->file('urun_resmi');
            $urun_resmi = \request()->urun_resmi;
            $dosyaadi = $entry->id . "_" .time() . ".".$urun_resmi->extension();

            if($urun_resmi->isValid()){
                $urun_resmi->move('uploads/urunler',$dosyaadi);

                UrunDetay::updateOrCreate(
                    ['urun_id'=>$entry->id],
                    ['urun_resmi'=>$dosyaadi],
                    ['goster_slider'=>'goster_slider'],
                    ['goster_gunun_firsati'=>'goster_gunun_firsati'],
                    ['goster_one_cikan'=>'goster_one_cikan'],
                    ['goster_cok_satan'=>'goster_cok_satan'],
                    ['goster_indirimli'=>'goster_indirimli'],
                    ['urun_adet'=>'urun_adet']
                );
            }
        }

        return redirect()->route('yonetim.urun.duzenle',$entry->id)->with('mesaj',($id>0 ? 'Guncellendi':'Kaydedildi'))
            ->with('mesaj_tur','success');
    }
    public function sil($id){

        $urun = Urun::find($id);
        $urun->kategoriler()->detach();
        $urun->delete();

        return redirect()->route('yonetim.urun')->with('mesaj','Kayıt Silindi')->with('mesaj_tur','success');
    }
}
