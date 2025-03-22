<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    protected $fillable = [
      'number',
      'number_chairs',
    ];
    public function getRouteKeyName()
    {
        return 'number';
    }
    public function table_reservations ()
    {
        return $this->hasMany(TableReserve::class);
    }
}
