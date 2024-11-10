<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    use Uuid, HasFactory;

    protected $fillable = ['pid', 'categori', 'data', 'status', 'key1', 'key2', 'key3'];
}
