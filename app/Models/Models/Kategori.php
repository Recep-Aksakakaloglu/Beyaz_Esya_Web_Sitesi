<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "kategori";
    //protected $fillable = ['kategori_adi','slug'];
    protected $guarded = [];
    //const CREATED_AT = 'olusturulma_tarihi';
    //const UPDATED_AT =  'guncelleme_tarihi';
    //const DELETED_AT = 'silinme_tarihi';

    public function urunler()
    {
        return $this->belongsToMany('App\Models\Models\Urun','kategori_urun');
    }

    public function ust_kategori(){
        return $this->belongsTo('App\Models\Models\Kategori','ust_id')->withDefault([
            'kategori_ad'=>'Ana Kategori'
        ]);
    }
}
