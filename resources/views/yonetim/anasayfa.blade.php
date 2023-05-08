@extends('yonetim.layouts.master')
@section('title','Anasayfa')
@section('content')
    <br>
    <h1 class="page-header">Admin Paneli</h1>

    <section class="row text-center placeholders">
        <div class="col-6 col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Bekleyen Siparişler</div>
                <div class="panel-body">
                    <h4>{{$bekleyen_siparis}}</h4>
                    <p>adet bekleyen sipariş bulunmakta</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Ödemesi Onaylanan</div>
                <div class="panel-body">
                    <h4>{{$onaylı_siparis}}</h4>
                    <p>adet siparişin ödemesi onaylandı</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Kargoya Verilen</div>
                <div class="panel-body">
                    <h4>{{$kargoya_verilen}}</h4>
                    <p>adet sipariş teslim edilmek üzere kargoya verildi</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Teslim Edilen</div>
                <div class="panel-body">
                    <h4>{{$tamamlanan_siparis}}</h4>
                    <p>adet sipariş başarıyla teslim edildi</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Toplam Ürün Adedi</div>
                <div class="panel-body">
                    <h4>{{$toplam_urun}}</h4>
                    <p></p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Satılan Ürün Adedi</div>
                <div class="panel-body">
                    <h4>{{$satilan_urun}}</h4>
                    <p></p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Toplam Müşteri Sayımız</div>
                <div class="panel-body">
                    <h4>{{$musteri}}</h4>
                    <p></p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Toplam Yönetici Sayımız</div>
                <div class="panel-body">
                    <h4>{{$admin}}</h4>
                    <p></p>
                </div>
            </div>
        </div>
    </section>
@endsection
