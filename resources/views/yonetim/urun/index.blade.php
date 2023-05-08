@extends('yonetim.layouts.master')
@section('title','Ürün Yönetimi')
@section('content')
    <br>
    <h1 class="page-header">Ürün Yönetimi</h1>
    <h4 class="sub-header"> Ürün Listesi <h4>
            <hr>
            <div class="well">
                <div class="btn-group pull-right" role="group" aria-label="Basic example">
                    <a href="{{route('yonetim.urun.yeni')}}" class="btn btn-primary">Yeni Ürün Ekle</a>
                </div>
                <form method="post" action="{{route('yonetim.urun')}}" class="form-inline">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="search">Ara</label>
                        <input type="text" class="form-control form-group-sm" name="aranan" id="aranan" placeholder="Bir Ürün Arayın..."
                        value="{{old('aranan')}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Ara</button>
                    <a href="{{route('yonetim.urun')}}" class="btn btn-primary"> Temizle</a>
                </form>
            </div>
    @include('layouts.partials.alert')
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Resim</th>
                <th>Ürün Adı</th>
                <th>Fiyatı</th>
                <th>Adet</th>
                <th>Kayıt Tarihi</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $entry)
            <tr>
                <td>{{$entry->id}}</td>
                <td>
                    <img src="/uploads/urunler/{{$entry->detay->urun_resmi}}" style="width: 100px">
                </td>
                <td>{{$entry->urun_adi}}</td>
                <td>{{$entry->fiyati}}</td>
                <td>{{$entry->detay->urun_adet}}</td>
                <td>{{$entry->created_at}}</td>
                <td style="width: 100px">
                    <a href="{{route('yonetim.urun.duzenle',$entry->id)}}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
                        <span class="fa fa-pencil"></span>
                    </a>
                    <a href="{{route('yonetim.urun.sil',$entry->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Ürünü Silmek İstiyor Musunuz?')">
                        <span class="fa fa-trash"></span>
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{$list->appends('aranan',old('aranan'))->links()}}
    </div>
@endsection
