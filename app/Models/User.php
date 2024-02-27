<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Bicycle;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
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
    
    
    //このユーザーが所有している唯一の自転車
    public function bicycle()
    {
        return $this->hasOne(Bicycle::class);
    }
    
    //ユーザー自転車の名前を取得
    public function getBicycleName()
    {
        $bicycle = $this->bicycle()->first();
        //$bicycleが条件式、真なら$bicycle->nameが、それ以外はnullを返す
        return $bicycle ? $bicycle->name : null;
    }
}
