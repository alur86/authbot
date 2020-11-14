<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{
    use HasFactory;

protected $fillable = [
    'title', 'description', 'edited_at'
];


   public function user(){

   return $this->belongsTo(User::class, 'user_id');

  }

}
