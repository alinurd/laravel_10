<?php

namespace App\Models;

 use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    use HasFactory;

    protected $fillable = ['data', 'status', 'nama'];
    public $incrementing = true; 
    protected $keyType = 'int';
}
