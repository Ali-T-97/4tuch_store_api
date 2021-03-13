<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $fillable =[
      'User_id',
      'product_id',
      'adddres',
      'phone',
      'count'
    ];

    public function user(){
     return   $this->belongsTo(User::class);
    }
}
