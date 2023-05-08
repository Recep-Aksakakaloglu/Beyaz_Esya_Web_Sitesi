<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Yonetim\KullaniciController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'yonetim', 'namespace' => 'App\Http\Controllers\Yonetim'], function () {
    Route::redirect('/', '/yonetim/oturumac');

    Route::match(['get', 'post'], '/oturumac', 'KullaniciController@oturumac')->name('yonetim.oturumac');
    Route::get('/oturumukapat', 'KullaniciController@oturumukapat')->name('yonetim.oturumukapat');

    Route::group(['middleware' => 'yonetim'], function () {
        Route::get('/anasayfa', 'AnasayfaController@index')->name('yonetim.anasayfa');

        Route::group(['prefix' => 'kullanici'], function () {
            Route::match(['get', 'post'], '/', 'KullaniciController@index')->name('yonetim.kullanici');
            Route::get('/yeni', 'KullaniciController@form')->name('yonetim.kullanici.yeni');
            Route::get('/duzenle/{id}', 'KullaniciController@form')->name('yonetim.kullanici.duzenle');
            Route::post('/kaydet/{id?}', 'KullaniciController@kaydet')->name('yonetim.kullanici.kaydet');
            Route::get('/sil/{id}', 'KullaniciController@sil')->name('yonetim.kullanici.sil');
        });

        Route::group(['prefix' => 'kategori'], function () {
            Route::match(['get', 'post'], '/', 'KategoriController@index')->name('yonetim.kategori');
            Route::get('/yeni', 'KategoriController@form')->name('yonetim.kategori.yeni');
            Route::get('/duzenle/{id}', 'KategoriController@form')->name('yonetim.kategori.duzenle');
            Route::post('/kaydet/{id?}', 'KategoriController@kaydet')->name('yonetim.kategori.kaydet');
            Route::get('/sil/{id}', 'KategoriController@sil')->name('yonetim.kategori.sil');
        });

        Route::group(['prefix' => 'urun'], function () {
            Route::match(['get', 'post'], '/', 'UrunController@index')->name('yonetim.urun');
            Route::get('/yeni', 'UrunController@form')->name('yonetim.urun.yeni');
            Route::get('/duzenle/{id}', 'UrunController@form')->name('yonetim.urun.duzenle');
            Route::post('/kaydet/{id?}', 'UrunController@kaydet')->name('yonetim.urun.kaydet');
            Route::get('/sil/{id}', 'UrunController@sil')->name('yonetim.urun.sil');
        });

        Route::group(['prefix' => 'siparis'], function () {
            Route::match(['get', 'post'], '/', 'SiparisController@index')->name('yonetim.siparis');
            Route::get('/yeni', 'SiparisController@form')->name('yonetim.siparis.yeni');
            Route::get('/duzenle/{id}', 'SiparisController@form')->name('yonetim.siparis.duzenle');
            Route::post('/kaydet/{id?}', 'SiparisController@kaydet')->name('yonetim.siparis.kaydet');
            Route::get('/sil/{id}', 'SiparisController@sil')->name('yonetim.siparis.sil');
        });

    });
});

Route::get('/', 'App\Http\Controllers\AnasayfaController@index')->name('anasayfa');

Route::get('/kategori/{slug_kategoriadi}', 'App\Http\Controllers\KategoriController@index')->name('kategori');

Route::get('/urun/{slug_urunadi}', 'App\Http\Controllers\UrunController@index')->name('urun');

Route::post('/ara', 'App\Http\Controllers\UrunController@ara')->name('urun_ara');
Route::get('/ara', 'App\Http\Controllers\UrunController@ara')->name('urun_ara');

Route::group(['prefix' => 'sepet'], function () {
    Route::get('/', 'App\Http\Controllers\SepetController@index')->name('sepet');
    Route::post('/ekle', 'App\Http\Controllers\SepetController@ekle')->name('sepet.ekle');
    Route::delete('/kaldir/{rowid}', 'App\Http\Controllers\SepetController@kaldir')->name('sepet.kaldir');
    Route::delete('/bosalt', 'App\Http\Controllers\SepetController@bosalt')->name('sepet.bosalt');
    Route::patch('/guncelle/{rowid}', 'App\Http\Controllers\SepetController@guncelle')->name('sepet.guncelle');
});

Route::get('/odeme', 'App\Http\Controllers\OdemeController@index')->name('odeme');
Route::post('/odeme', 'App\Http\Controllers\OdemeController@odemeyap')->name('odemeyap');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/siparisler', 'App\Http\Controllers\SiparisController@index')->name('siparisler');
    Route::get('/siparisler/{id}', 'App\Http\Controllers\SiparisController@detay')->name('siparis');
});

Route::group(['prefix' => 'kullanici'], function () {
    Route::get('/oturumac', 'App\Http\Controllers\KullaniciController@giris_form')->name('kullanici.oturumac');
    Route::post('/oturumac', 'App\Http\Controllers\KullaniciController@giris');
    Route::get('/kaydol', 'App\Http\Controllers\KullaniciController@kaydol_form')->name('kullanici.kaydol');
    Route::post('/kaydol', 'App\Http\Controllers\KullaniciController@kaydol');
    Route::get('/aktiflestir/{anahtar}', 'App\Http\Controllers\KullaniciController@aktiflestir')->name('aktiflestir');
    Route::post('/oturumukapat', 'App\Http\Controllers\KullaniciController@oturumukapat')->name('oturumukapat');
    Route::get('/kullanicidetay', 'App\Http\Controllers\KullaniciController@detayform')->name('kullanici.kullanicidetay');
    //Route::get('/detayform/{id}', 'App\Http\Controllers\KullaniciController@detayform')->name('detayform');
    //Route::post('/kullanicidetay/{id}', 'App\Http\Controllers\KullaniciController@detay')->name('kullanicidetay');
});

Route::get('/test/mail', function () {
    $kullanici = \App\Models\Kullanici::find(1);

    return new App\Mail\KullaniciKayitMail($kullanici);
});



/*Route::get('/merhaba', function (){
    return "Merhaba";
});

Route::get('/api/v1/merhaba', function (){
    return['mesaj'=>'Merhaba'];
});

Route::get('urun/{isim}/{id?}',function ($urunadi, $id=0){
    return"Ürün Adı: $id $urunadi";
})->name('urun_detay');

Route::get('/kampanya',function (){
    return redirect()->route('urun_detay', ['isim'=>'elma','id'=>5]);
});*/
