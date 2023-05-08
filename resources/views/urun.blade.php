@extends('layouts.master')
@section('title', $urun->urun_adi)
@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#">Anasayfa</a></li>
            @foreach($kategoriler as  $kategori)
            <li><a href="{{route('kategori',$kategori->slug)}}">{{$kategori->kategori_adi}}</a></li>
            @endforeach
            <li class="active">{{$urun->urun_adi}}</li>
        </ol>
        <div class="bg-content">
            <div class="row">
                <div class="col-md-5">
                    <img style="width: 250px" src="/uploads/urunler/{{$urun->detay->urun_resmi}}">
                    <hr>
                </div>
                <div class="col-md-7">
                    <h1>{{$urun->urun_adi}}</h1>
                    <p class="price">{{$urun->fiyati}} ₺</p>
                    <form action="{{route('sepet.ekle')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$urun->id}}">
                        <input type="submit" class="btn btn-theme" value="Sepete Ekle">
                    </form>

                </div>
            </div>

            <div>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#t1" data-toggle="tab">Ürün Açıklaması</a></li>
                    <li role="presentation"><a href="#t2" data-toggle="tab">Yorumlar</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="t1">{{$urun->aciklama}}</div>
                    <div role="tabpanel" class="tab-pane" id="t2">
                        İlk Yorum Yapan Siz Olun
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
