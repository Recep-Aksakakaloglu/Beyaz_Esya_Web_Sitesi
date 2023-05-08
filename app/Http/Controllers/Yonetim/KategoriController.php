<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use App\Models\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(){
        \request()->flash();
        if(request()->filled('aranan')){
            $aranan = \request('aranan');
            $list = Kategori::where('kategori_adi','like','%$aranan%')->orderBy('id')->paginate(8);
        }else {
            $list = Kategori::orderBy('id')->paginate(8);
        }

        $anakategoriler = Kategori::whereRaw('ust_id is null')->get();

        return view('yonetim.kategori.index',compact('list','anakategoriler'));
    }
    public function form($id = 0){
        $entry = new Kategori;
        if($id>0){
            $entry = Kategori::find($id);
        }

        $kategoriler = Kategori::all();
        return view('yonetim.kategori.form',compact('entry','kategoriler'));
    }
    public function kaydet($id = 0){
        $this->validate(\request(),[
            'kategori_adi'=>'required',
            'slug'=>'unique:kategori,slug'
        ]);

        $data = \request()->only('kategori_adi','slug','ust_id');
        /*if(\request()->filled('slug'))
        {
            $data['slug'] = str_slug(\request('kategori_adi'));
            \request()->merge(['slug'=>$data['slug']]);
        }*/

        $this->validate(\request(),[
            'kategori_adi'=>'required',
            'slug'=>(request('original_slug')!=\request('slug') ? 'unique:kategori,slug' : '')
        ]);

        if($id>0){
            $entry = Kategori::where('id',$id)->firstOrFail();
            $entry->update($data);
        }else{
            $entry = Kategori::create($data);
        }
        return redirect()->route('yonetim.kategori.duzenle',$entry->id)->with('mesaj',($id>0 ? 'Guncellendi':'Kaydedildi'))
            ->with('mesaj_tur','success');
    }
    public function sil($id){
        $kategori =  Kategori::find($id);
        $kategori->urunler()->detach();
        Kategori::destroy($id);
        return redirect()->route('yonetim.kategori')->with('mesaj','Kayıt Silindi')->with('mesaj_tur','success');
    }
}
