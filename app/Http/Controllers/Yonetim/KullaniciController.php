<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use App\Models\Models\Kullanici;
use Illuminate\Http\Request;
use Auth;
use Hash;

class KullaniciController extends Controller
{
    public function oturumac(){
        if (request()->isMethod('POST')){
            $this->validate(request(),[
                'email' => 'required|email',
                'sifre'=> 'required'
            ]);

            $credantials = [
                'email' => request()->get('email'),
                'password'=>\request()->get('sifre'),
                'yonetici_mi'=>1
            ];
            if (Auth::guard('yonetim')->attempt($credantials,\request()->has('benihatirla'))){
              return redirect()->route('yonetim.anasayfa');
            }else{
                return back()->withInput()->withErrors(['email'=>'Giriş Hatalı']);
            }
        }
        return view('yonetim.oturumac');
    }
    public function oturumukapat(){
        Auth::guard('yonetim')->logout();
        \request()->session()->flush();
        \request()->session()->regenerate();

        return redirect()->route('yonetim.oturumac');
    }
    public function index(){
        \request()->flash();
        if(request()->filled('aranan')){
            $aranan = \request('aranan');
            $list = Kullanici::where('adsoyad','like','%$aranan%')->orWhere('email','like','%$aranan%')->
            orderByDesc('created_at')->paginate(8);
        }else {
            $list = Kullanici::orderByDesc('created_at')->paginate(8);
        }
        return view('yonetim.kullanici.index',compact('list'));
    }
    public function form($id = 0){
        $entry = new Kullanici;
        if($id>0){
            $entry = Kullanici::find($id);
        }
        return view('yonetim.kullanici.form',compact('entry'));
    }
    public function kaydet($id = 0){
        $this->validate(\request(),[
           'adsoyad'=>'required',
           'email'=>'required|email'
        ]);

        $data = \request()->only('adsoyad','email');
        if(\request()->filled('sifre')){
            $data['sifre'] = Hash::make(\request('sifre'));
        }

        $data['aktif_mi'] = \request()->has('aktif_mi') && \request('aktif_mi')==1 ? 1 : 0;
        $data['yonetici_mi'] = \request()->has('yonetici_mi') && \request('yonetici_mi')==1 ? 1 : 0;

        if($id>0){
            $entry = Kullanici::where('id',$id)->firstOrFail();
            $entry->update($data);
        }else{
            $entry = Kullanici::create($data);
        }
        return redirect()->route('yonetim.kullanici.duzenle',$entry->id)->with('mesaj',($id>0 ? 'Guncellendi':'Kaydedildi'))
            ->with('mesaj_tur','success');
    }
    public function sil($id){
        Kullanici::destroy($id);
        return redirect()->route('yonetim.kullanici')->with('mesaj','Kayıt Silindi')->with('mesaj_tur','success');
    }
}
