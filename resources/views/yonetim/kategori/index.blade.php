@extends('yonetim.layouts.master')
@section('title','Kategori Yönetimi')
@section('content')
    <br>
    <h1 class="page-header">Kategori Yönetimi</h1>
    <h4 class="sub-header"> Kategori Listesi <h4>
            <hr>
            <div class="well">
                <div class="btn-group pull-right" role="group" aria-label="Basic example">
                    <a href="{{route('yonetim.kategori.yeni')}}" class="btn btn-primary">Yeni Kategori Ekle</a>
                </div>
                <form method="post" action="{{route('yonetim.kategori')}}" class="form-inline">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="search">Ara</label>
                        <input type="text" class="form-control form-group-sm" name="aranan" id="aranan" placeholder="Bir Kategori Arayın..."
                        value="{{old('aranan')}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Ara</button>
                    <a href="{{route('yonetim.kategori')}}" class="btn btn-primary"> Temizle</a>
                </form>
            </div>
    @include('layouts.partials.alert')
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Üst Kategori</th>
                <th>Slug</th>
                <th>Kategori Adı</th>
                <th>Kayıt Tarihi</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $entry)
            <tr>
                <td>{{$entry->id}}</td>
                <td>{{$entry->ust_kategori->kategori_adi}}</td>
                <td>{{$entry->slug}}</td>
                <td>{{$entry->kategori_adi}}</td>
                <td>{{$entry->created_at}}</td>
                <td style="width: 100px">
                    <a href="{{route('yonetim.kategori.duzenle',$entry->id)}}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
                        <span class="fa fa-pencil"></span>
                    </a>
                    <a href="{{route('yonetim.kategori.sil',$entry->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Kategoriyi Silmek İstiyor Musunuz?')">
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
