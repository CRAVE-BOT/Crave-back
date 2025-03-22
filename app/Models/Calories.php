<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calories extends Model
{
    use HasFactory;
    protected $table = 'calories';
    protected $fillable = [
        'gender',
      'user_id',
      'age',
      'weight',
      'tall',
      'goal',
      'activity',
      'total_calories',
    ];
}
