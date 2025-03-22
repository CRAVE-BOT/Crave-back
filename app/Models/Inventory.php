<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $table = 'inventories';
    protected $fillable = [
        'name',
        'Current_price',
        'Previous_price',
        'quantity',
    ];





    public function getRouteKeyName(){
        return 'name';
}
}
