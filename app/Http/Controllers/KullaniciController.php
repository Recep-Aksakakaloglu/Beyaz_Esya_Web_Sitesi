<?php

namespace App\Http\Controllers;

use App\Mail\KullaniciKayitMail;
use App\Models\Models\Kategori;
use App\Models\Models\Kullanici;
use App\Models\Models\KullaniciDetay;
use App\Models\Models\Sepet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use function GuzzleHttp\Promise\rejection_for;

class KullaniciController extends Controller
{

    public function __construct(){
        $this->middleware('guest')->except('oturumukapat');
    }
    public function giris_form(){
        return view('kullanici.oturumac');
    }
    public function giris(){
        $this->validate(request(),[
           'email'=>'required|email',
           'sifre'=>'required'
        ]);

        $credentials = [
            'email' => \request('email'),
            'password'=>\request('sifre'),
            'aktif_mi'=>1
        ];

        if (auth()->attempt($credentials, request()->has('benihatirla')))
        {
            request()->session()->regenerate();

            /*$aktif_sepet_id = Sepet::aktif_sepet_id();
            if(is_null($aktif_sepet_id)){
                $aktif_sepet = Sepet::create(['kullanici_id'=>auth()->id()]);
                $aktif_sepet_id = $aktif_sepet->id;
            }*/
            //dd($aktif_sepet_id);

            return redirect()->intended('/');
        }else{
            $errors = ['email'=>'Hatalı Giriş'];
            return back()->withErrors($errors);
        }
    }
    public function  kaydol_form(){
        return view('kullanici.kaydol');
    }
    public function kaydol(){

        $this->validate(request(),[
            'adsoyad'=>'required|min:5|max:60',
            'email' =>'required|email|unique:kullanici',
            'sifre' =>'required|confirmed|min:5|max:15'
        ]);

        $kullanici = Kullanici::create([
            'adsoyad'=>request('adsoyad'),
            'email'=>request('email'),
            'sifre'=>Hash::make(request('sifre')),
            'aktivasyon_anahtari'=>Str::random(60),
            'aktif_mi'=>0
        ]);

        $kullanici->detay()->save(new KullaniciDetay());

        Mail::to(request('email'))->send(new KullaniciKayitMail($kullanici));

        auth()->login($kullanici);

        $detay = \request()->only('adres','telefon','ceptelefonu');

        $entry = KullaniciDetay::where('kullanici_id',auth()->id())->firstOrFail();
        $entry->update($detay);

        return redirect()->route('anasayfa');
    }
    public function aktiflestir($anahtar){
        $kullanici = Kullanici::where('aktivasyon_anahtari',$anahtar)->first();
        if(!is_null($kullanici)){
            $kullanici->aktivasyon_anahtari = null;
            $kullanici->aktif_mi=1;
            $kullanici->save();
            return redirect()->to('/')->with('mesaj','Kullanıcı Kaydınız Başarıyla Aktifleştirilmiştir')->with('mesaj_tur','success');
        }else{
            return redirect()->to('/')->with('mesaj','Aktif Kullanıcı Kaydınız Bulunamadı')->with('mesaj_tur','warning');
        }
    }

    public function detayform(){
        $entry = new KullaniciDetay;
        $entry = KullaniciDetay::where('kullanici_id',auth()->id);
        dd($entry);
        return view('kullanicidetay',compact('entry'));
    }
    public function detay($id){
        $this->validate(\request(),[
            'adres'=>'required',
            'telefon'=>'required',
            'ceptelefonu'=>'required'
        ]);

        $data = \request()->only('adres','telefon','ceptelefonu');

        $entry = KullaniciDetay::where('kullanici_id',$id)->firstOrFail();
        $entry->update($data);

        return redirect()->route('kullanicidetay',$entry->id)->with('mesaj','Guncellendi')
            ->with('mesaj_tur','success');
    }
    public function oturumukapat(){
        auth()->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route('anasayfa');
    }

}
