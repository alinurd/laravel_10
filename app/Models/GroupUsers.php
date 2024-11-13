<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupUsers extends Model
{
    use HasFactory;
    
    protected $table = "group_users";

    // Relasi ke ViewGroupPermissions berdasarkan group_id
    public function getPermission()
    {
        return $this->hasMany(ViewGroupPermissions::class, 'id', 'group_id');
    }

    // Relasi ke MenuGroup sebagai Parent berdasarkan menu_group_id di ViewGroupPermissions
    public function getMenuParent()
    {
        return $this->hasOne(MenuGroup::class, 'id', 'menu_group_id');
    }

    // Relasi ke MenuGroup sebagai Items berdasarkan menu_item_id di ViewGroupPermissions
    public function getMenuItems()
    {
        return $this->hasOne(MenuGroup::class, 'id', 'menu_item_id');
    }
}

