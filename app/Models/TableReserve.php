<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableReserve extends Model
{
    use HasFactory;
    protected $table = 'table_reserves';
    public function user (){
    return $this->belongsTo(User::class);
}
    public function table (){
        return $this->belongsTo(Table::class);
    }
    protected $fillable = [
        'table_id',
        'user_id',
        'date',
        'the_time',
        'number_people',
    ];
    public function getRouteKeyName()
    {
        return 'id';
    }
}
