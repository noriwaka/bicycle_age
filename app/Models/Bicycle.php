<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Part;

class Bicycle extends Model
{
    use HasFactory;
    
    protected $fillable = [
       'user_id', 'name', 'total_mileage',
    ];
    
    //この自転車を所有する唯一のユーザー
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    //この自転車が所有する複数のパーツ
    
    public function parts()
    {
        return $this->hasMany(Part::class);
    }
    
    
    
    
}
