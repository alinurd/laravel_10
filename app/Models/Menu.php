<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url', 'icon', 'parent_id', 'position'];

    // public function children()
    // {
    //     return $this->hasMany(Menu::class, 'parent_id')->orderBy('position');
    // }
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id')->with('children');
    }
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }
    
}
