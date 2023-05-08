<h1>{{config('app.name')}}</h1>
<p>Merhaba {{$kullanici->adsoyad}}, Kaydınız Başarılı Bir Şekilde Tamamlandı</p>
<p>Kaydınızı Aktifleştirmekİçin <a href="{{config('app.url')}}/kullanici/aktiflestir/{{$kullanici->aktivasyon_anahtari}}">tıklayın</a> veya aşağıdaki bağlantıyı tarayıcınızda açın.</p>
<p>{{config('app.url')}}/kullanici/aktiflestir/{{$kullanici->aktivasyon_anahtari}}</p>
