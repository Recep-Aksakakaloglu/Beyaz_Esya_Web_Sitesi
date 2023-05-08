@extends('layouts.master')
@section('title','Sepet')
@section('content')
    <div class="container">
        <div class="bg-content">
            <h2>Sepet</h2>
            @include('layouts.partials.alert')
            <table class="table table-bordererd table-hover">
                <tr>
                    <th >Ürün Görseli</th>
                    <th >Ürün Adı</th>
                    <th>Adet Fiyatı</th>
                    <th>Adet</th>
                    <th>Tutar</th>
                </tr>
                @foreach($urun as $urunler)
                <tr>
                    <td><a style="width: 120px" href="{{route('urun',$urunler->slug)}}"><img width="150px" src="/uploads/urunler/{{$urunler->detay->urun_resmi}}"></a></td>
                    <td>
                            <a href="{{route('urun',$urunler->slug)}}">{{$urunler->urun_adi}}</a>
                    </td>
                    <td>{{$urunler->fiyati}}</td>
                    <td>
                        <a href="#" class="btn btn-xs btn-default urun-adet-azalt" data-id = "1" data-adet="0">-</a>
                        <span style="padding: 10px 20px">1</span>
                        <a href="#" class="btn btn-xs btn-default urun-adet-artir" data-id = "1" data-adet="2">+</a>
                    </td>

                    <td class="">
                        {{($urunler->fiyati)}}
                    </td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="4" class="text-right">Ara Toplam</th>
                    <th>{{$urunler->fiyati}} TL</th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">KDV</th>
                    <th>{{($urunler->fiyati * (18/100))*1000}} TL</th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Genel Toplam</th>
                    <th>{{(($urunler->fiyati) + ($urunler->fiyati * (18/100)))*1000}} TL</th>
                </tr>
            </table>
            <div>
                <a href="{{route('odeme')}}" class="btn btn-success pull-right btn-lg">Ödeme Yap</a>
            </div>
        </div>
    </div>
@endsection
