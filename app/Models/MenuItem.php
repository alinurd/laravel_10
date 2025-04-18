<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class MenuItem extends Model
{
    use Uuid, HasFactory;

    protected $fillable = ['name', 'modul', 'icon', 'route', 'status', 'permission_name', 'menu_group_id', 'posision'];

    protected $casts = ['status' => 'boolean'];

    public function menuGroup()
    {
        return $this->belongsTo(MenuGroup::class, 'menu_group_id', 'id');
    }

    public function getMenuParent()
    {
        return $this->belongsTo(ViewGroupPermissions::class, 'route', 'menu_item_route');
    }
    
}
