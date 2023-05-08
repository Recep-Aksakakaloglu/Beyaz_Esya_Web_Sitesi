<?php

namespace App\Http\Controllers;

use App\Models\Models\Sepet;
use App\Models\Models\SepetUrun;
use App\Models\Models\Urun;
use App\Models\Models\UrunDetay;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;

class SepetController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        //$urunler = Urun::find(request('id'));
        //$urunler = Sepet::find('kullanici_id',auth()->user('id'));
        //$sepet = Sepet::where('kullanici_id',auth()->id())->orderByDesc('created_at')->get();
        //$sepet2 = Sepet::where('kullanici_id',auth()->id())->orderByDesc('created_at')->firstOrFail();
        $sepet = Sepet::where('kullanici_id',auth()->id())->orderByDesc('created_at')->firstOrFail();

        $sepet_urun = SepetUrun::where('sepet_id',$sepet->id)->orderByDesc('created_at')->firstOrFail();
        //dd($sepet_urun);
        $urun = Urun::where('id',$sepet_urun->urun_id)->get();
        //$urunler = SepetUrun::where('sepet_id',6)->get();
        //$mal = Urun::where('id',SepetUrun::where('sepet_id',6)->get('id'));
        return view('sepet',compact('urun'));
    }

    public function ekle(){
        /*$urun = Urun::find(request('id'));
        Client::create([
            'urun_adi' => $urun->urun_adi,
            'fiyati' => $urun->fiyati,
        ]);*/

        $urun = Urun::find(request('id'));

        if(auth()->check())
        {
            $aktif_sepet_id = session('aktif_sepet_id');
            if(!isset($aktif_sepet_id)) {
                $aktif_sepet = Sepet::create([
                    'kullanici_id' => auth()->id()
                ]);
                $aktif_sepet_id = $aktif_sepet->id;
                session()->put('aktif_sepet_id', $aktif_sepet_id);
            }

            SepetUrun::updateOrCreate(
                ['sepet_id'=>$aktif_sepet_id, 'urun_id'=>$urun->id],
                ['adet'=>1, 'tutar'=>$urun->fiyati, 'durum' => 'Beklemede']
            );
        }

        return redirect()->route('sepet')->with('mesaj_tur','success')->with('mesaj','Ürün Sepete Eklendi.');
    }

    /*public function  kaldir($rowid){
        if (auth()->check()){
            $aktif_sepet_id = session('aktif_sepet_id');
            SepetUrun::where('sepet_id',$aktif_sepet_id)->where('urun_id',1)->delete();
        }
        return redirect()->route('sepet')
            ->with('mesaj_tur', 'success')
            ->with('mesaj', 'Ürün sepetten kaldırıldı.');
    }

    public function guncelle($rowid){
        if(auth()->check()){
            $aktif_sepet_id = session('aktif_sepet_id');
        }
        return response()->json(['success' => true]);
    }*/
}
