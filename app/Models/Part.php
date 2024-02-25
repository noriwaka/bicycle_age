<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bicycle;

class Part extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'bicycle_id', 'name', 'mileage',
    ];
    
    //このパーツを所有している自転車
    
    public function bicycle()
    {
        return $this->belongsTo(Bicycle::class);
    }
    
}
