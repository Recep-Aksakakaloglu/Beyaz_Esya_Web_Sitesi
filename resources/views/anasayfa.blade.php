@extends('layouts.master')
@section('title','Anasayfa')
@section('content')
    @include('layouts.partials.alert')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Kategoriler</div>
                    <div class="list-group categories">
                        @foreach($kategoriler as $kategori)
                        <a href="{{route('kategori',$kategori->slug)}}" class="list-group-item"><i class="fa fa-arrow-circle-o-right"></i> {{$kategori->kategori_adi}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @for($i=0;$i<count($urunler_slider);$i++)
                        <li data-target="#carousel-example-generic" data-slide-to="{{$i}}" class="{{$i==0 ? 'active':''}}"></li>
                        @endfor
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        @foreach($urunler_slider as $index=>$urun_detay)
                        <div class="item {{$index==0 ? 'active':''}}">
                            <a href="{{route('urun',$urun_detay->urun->slug)}}"><img src="/uploads/urunler/{{$urun_detay->urun->detay->urun_resmi}}" alt="..."></a>
                            <div class="carousel-caption">
                                <a href="{{route('urun',$urun_detay->urun->slug)}}">{{$urun_detay->urun->urun_adi}}</a>
                            </div>
                        </div>
                            @endforeach
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default" id="sidebar-product">
                    <div class="panel-heading">Günün Fırsatı</div>
                    <div class="panel-body">
                        <a href="{{route('urun',$urun_gunun_firsati->slug)}}">
                            <img src="{{$urun_gunun_firsati->detay->urun_resmi!=null ? asset('uploads/urunler/'.$urun_gunun_firsati->detay->urun_resmi) : 'data:image/png;base64,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'}}" class="img-responsive" style="min-width:100% ">
                        {{$urun_gunun_firsati->urun_adi}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">Öne Çıkan Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($urunler_one_cikan as $urun_detay)
                        <div class="col-md-3 product">
                            <a href="{{route('urun',$urun_detay->urun->slug)}}"><img src="/uploads/urunler/{{$urun_detay->urun_resmi}}"></a>
                            <p><a href="{{route('urun',$urun_detay->urun->slug)}}">{{$urun_detay->urun->urun_adi}}</a></p>
                            <p class="price">{{$urun_detay->urun->fiyati}} ₺</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">Çok Satan Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($urunler_cok_satan as $urun_detay)
                            <div class="col-md-3 product">
                                <a href="{{route('urun',$urun_detay->urun->slug)}}"><img src="/uploads/urunler/{{$urun_detay->urun_resmi}}"></a>
                                <p><a href="{{route('urun',$urun_detay->urun->slug)}}">{{$urun_detay->urun->urun_adi}}</a></p>
                                <p class="price">{{$urun_detay->urun->fiyati}} ₺</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">İndirimli Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($urunler_indirimli as $urun_detay)
                            <div class="col-md-3 product">
                                <a href="{{route('urun',$urun_detay->urun->slug)}}"><img src="/uploads/urunler/{{$urun_detay->urun_resmi}}"></a>
                                <p><a href="{{route('urun',$urun_detay->urun->slug)}}">{{$urun_detay->urun->urun_adi}}</a></p>
                                <p class="price">{{$urun_detay->urun->fiyati}} ₺</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
