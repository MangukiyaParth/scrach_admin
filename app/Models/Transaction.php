<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    public $table='transaction';
    public $timestamps=false;
    
    
    public function name(){
       return $hasOne(\Users::class, 'uid')->name();
    }
}
