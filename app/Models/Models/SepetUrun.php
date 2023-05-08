<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SepetUrun extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "sepet_urun";
    protected $guarded = [];

    public function urun()
    {
        return $this->belongsTo('App\Models\Models\Urun');
    }
}
