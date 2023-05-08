<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori_Urun extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "kategori_urun";
    protected $guarded = [];
}
