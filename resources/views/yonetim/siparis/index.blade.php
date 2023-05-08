@extends('yonetim.layouts.master')
@section('title','Sipariş Yönetimi')
@section('content')
    <br>
    <h1 class="page-header">Sipariş Yönetimi</h1>
    <h4 class="sub-header"> Sipariş Listesi <h4>
            <hr>
            <div class="well">
                <div class="btn-group pull-right" role="group" aria-label="Basic example">
                    <a href="{{route('yonetim.siparis.yeni')}}" class="btn btn-primary">Yeni Sipariş Ekle</a>
                </div>
                <form method="post" action="{{route('yonetim.siparis')}}" class="form-inline">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="search">Ara</label>
                        <input type="text" class="form-control form-group-sm" name="aranan" id="aranan" placeholder="Bir Sipariş Arayın..."
                        value="{{old('aranan')}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Ara</button>
                    <a href="{{route('yonetim.siparis')}}" class="btn btn-primary"> Temizle</a>
                </form>
            </div>
    @include('layouts.partials.alert')
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Sipariş Veren</th>
                <th>Sipariş Kodu</th>
                <th>Tutar</th>
                <th>Durum</th>
                <th>Sipariş Tarihi</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $entry)
            <tr>
                <td>{{$entry->id}}</td>
                <td>{{$entry->sepet->kullanici->adsoyad}}</td>
                <td>SP-{{$entry->id}}</td>
                <td>{{$entry->siparis_tutari * (118000/100)}} ₺</td>
                <td>{{$entry->durum}}</td>
                <td>{{$entry->created_at}}</td>
                <td style="width: 100px">
                    <a href="{{route('yonetim.siparis.duzenle',$entry->id)}}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
                        <span class="fa fa-pencil"></span>
                    </a>
                    <a href="{{route('yonetim.siparis.sil',$entry->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Siparişi Silmek İstiyor Musunuz?')">
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
