<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrunDetay extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = "urun_detay";

    public function urun()
    {
        return $this->belongsTo('App\Models\Models\Urun');
    }
}
