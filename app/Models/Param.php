<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Param extends Model
{
    use HasFactory;
    protected $table = 'combo';  // Specify the correct table name
        protected $fillable = ['pid', 'categori', 'data', 'status', 'key1', 'key2', 'key3'];
}