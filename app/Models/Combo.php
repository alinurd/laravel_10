<?php

namespace App\Models;

 use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    use HasFactory;

    protected $fillable = ['pid', 'categori', 'data', 'status', 'key1', 'key2', 'key3'];
    public $incrementing = true; // Pastikan ini true untuk auto-increment integer
    protected $keyType = 'int'; // Set tipe data primary key ke integer
}
