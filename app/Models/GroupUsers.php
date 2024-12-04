<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupUsers extends Model
{
    use HasFactory;

    protected $table = "group_users";

    protected $fillable = ['user_id', 'group_id'];

    public function getCountByUser()
    {
        return \DB::table('groups')
            ->leftJoin('group_users', 'groups.id', '=', 'group_users.group_id')
            ->select('groups.id as group_id', 'groups.name as group_name')
            ->selectRaw('COUNT(group_users.user_id) as user_count')
            ->groupBy('groups.id', 'groups.name')
            ->get();
    }

    public function getPermission()
    {
        return $this->hasMany(ViewGroupPermissions::class, 'id', 'group_id');
    }

    public function getMenuParent()
    {
        return $this->hasOne(MenuGroup::class, 'id', 'menu_group_id');
    }

    public function getMenuItems()
    {
        return $this->hasOne(MenuGroup::class, 'id', 'menu_item_id');
    }
}
