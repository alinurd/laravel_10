<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupUsers extends Model
{
    use HasFactory;
    protected $table = "group_users";

    // Relasi ke view_group_permissions
    public function getPermission()
    {
        // Menghubungkan melalui group_id
        return $this->hasMany(ViewGroupPermissions::class, 'group_id', 'group_id');
    }
}
