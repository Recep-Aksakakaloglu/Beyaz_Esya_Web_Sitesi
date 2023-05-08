@extends('layouts.master')
@section('title','Sipariş Detayı')
@section('content')
    <div class="container">
        <div class="bg-content">
            <a href="{{route('siparisler')}}" class="btn btn-xs btn-primary">
                <i class="glyphicon glyphicon-arrow-left"></i>
                Siparişleri Gör
            </a>
            <h2>Sipariş (SP-{{$siparis->id}})</h2>
            <table class="table table-bordererd table-hover">
                <tr>
                    <th colspan="2">Ürün</th>
                    <th>Tutar</th>
                    <th>Adet</th>
                    <th>Durum</th>
                </tr>
                @foreach($siparis->sepet->sepet_urunler as $sepet_urun)
                <tr>

                    <td style="width: 120px;">
                        <a href="{{route('urun',$sepet_urun->urun->slug)}}">
                            <img src="{{ $sepet_urun->urun->detay->urun_resmi!=null ? asset('uploads/urunler/' . $sepet_urun->urun->detay->urun_resmi) : 'http://via.placeholder.com/120x100?text=UrunResmi' }}" style="height: 120px;">
                        </a>
                    </td>


                    <td>
                        <a href="{{route('urun',$sepet_urun->urun->slug)}}">
                        {{$sepet_urun->urun->urun_adi}}
                        </a>
                    </td>

                    <td>{{$sepet_urun->urun->fiyati}} ₺</td>
                    <td>{{$sepet_urun->adet}}</td>
                    <td>{{$sepet_urun->durum}}</td>

                </tr>
                @endforeach
                <tr>
                    <th colspan="4" class="text-right">Toplam Tutar:</th>
                    <td colspan="2">{{$siparis->siparis_tutari}} ₺</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Toplam Tutar (KDV dahil):</th>
                    <td colspan="2">{{$siparis->siparis_tutari * (118000/100)}} ₺</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Sipariş Durumu:</th>
                    <td colspan="2">{{$siparis->durum}}</td>
                </tr>
                <tr>
                    @if($siparis->durum == 'Sipariş tamamlandı')
                    <th colspan="4" class="text-right"><button class="btn btn-success" name="teslim" id="teslim" enabled>Ürünü Teslim Aldım</button></th>
                    <td colspan="2"></td>
                    @else
                        <th colspan="4" class="text-right"><button class="btn btn-warning" name="teslim" id="teslim" disabled>Ürünü Teslim Aldım</button></th>
                        <td colspan="2"></td>
                    @endif
                </tr>
            </table>
        </div>
    </div>
@endsection
