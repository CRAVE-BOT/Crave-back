<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function category(){
        return $this->belongsTo(Category::class);
    }
   public function order_detail(){
        return $this->hasMany(OrderDetail::class);
   }
    public function favorites(){
        return $this->hasMany(Favourite::class);
    }
    public function suggestions(){
        return $this->hasMany(Sugest::class);
    }

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'category_id',
        'total_calories',
        'protien',
        'carb',
        'fat',
        'weight',
        ];
    public function getRouteKeyName(){
        return 'name';
    }

}
