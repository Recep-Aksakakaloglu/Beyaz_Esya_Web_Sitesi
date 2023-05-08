<?php

namespace App\Models\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Kullanici extends Authenticatable
{
    use SoftDeletes;

    protected $table = "kullanici";

    protected $fillable = [
        'adsoyad',
        'email',
        'sifre',
        'aktivasyon_anahtari',
        'aktif_mi',
        'yonetici_mi'
    ];

    protected $hidden = [
        'sifre',
        'aktivasyon_anahtari',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->sifre;
    }

    public function detay(){
        return $this->hasOne('App\Models\Models\KullaniciDetay')->withDefault();
    }

}
