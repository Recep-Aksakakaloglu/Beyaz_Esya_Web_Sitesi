@extends('layouts.master')
@section('title','Kullanıcı Bilgileri')
@section('content')
    <h1 class="page-header">Kullanıcı Bilgileri</h1>

    <form method="post" action="{{route('detay',auth()->id())}}">
        {{csrf_field()}}
        <div class="pull-right">
            <button type="submit" class="btn btn-primary">
                Bilgilerimi Güncelle
            </button>
        </div>
        @include('layouts.partials.errors')
        @include('layouts.partials.alert')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="kategori_adi"></label>
                    <select name="ust_id" id="ust_id" class="form-control">
                        <option value="">Üst Kategori Seçin</option>

                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="kategori_adi">Kategori Adı</label>
                    <input type="text" class="form-control" id="kategori_adi" name="kategori_adi" placeholder="Kategori Adı" value="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="hidden" name="original_slug" value="">
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="">
                </div>
            </div>
        </div>
    </form>
@endsection
