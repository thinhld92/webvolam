<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "Account_Info";
    public $timestamps = false;
    public $primaryKey = 'iid';


    public function getAuthPassword()
    {
        return $this->cPassWord;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cAccName',
        'cPassWord',
        'cSecPassword',
        'cRealName',
        'dBirthDay',
        'cArea',
        'cIDNum',
        'dRegDate',
        'cPhone',
        'iClientID',
        'dLoginDate',
        'dLogoutDate',
        'iTimeCount',
        'cQuestion',
        'cAnswer',
        'cSex',
        'cDegree',
        'cEMail',
        'iLock',
        'gCode',
        'nMac',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'cPassWord',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function account_habitus(){
        return $this->hasOne(AccountHabitus::class, 'cAccName', 'cAccName');
    }

    public function payment(){
        return $this->hasMany(Payment::class, 'cAccName', 'cAccName');
    }

    public function getRegisterDateAttribute()
    {
        $register_date = date('d/m/Y', strtotime($this->dRegDate));
        return $register_date;
    }

    public function getPhotoAttribute()
    {
        $avatar = $this->avatar ?? 'https://ui-avatars.com/api/?name='
        . urlencode($this->cRealName)
        . '&color=7F9CF5&background=EBF4FF&size=256';
        return $avatar;
    }
}
