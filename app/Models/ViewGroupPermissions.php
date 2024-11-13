<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewGroupPermissions extends Model
{
    // Menetapkan nama view yang digunakan
    protected $table = 'view_group_permissions';

     public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

     protected $fillable = [
        'group_id', 'menu_group_id', 'menu_item_id', 'group_name', 
        'group_description', 'permission_type', 'menu_item_name', 'menu_item_route'
    ];
}
