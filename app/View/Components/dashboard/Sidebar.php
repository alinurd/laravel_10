<?php

namespace App\View\Components\dashboard;

use App\Models\GroupUsers;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\MenuGroup;
use App\Models\ViewGroupPermissions;
use Illuminate\Support\Facades\Auth;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $user = Auth::user();
        $groupUser = GroupUsers::where('user_id', $user->id)
        ->with('getPermission.getMenuParent', 'getPermission.getMenuItems')
        ->first();
        $menuWithPermission= ViewGroupPermissions::where('id', $groupUser->group_id)->where('permission_type','manage')->get();
    
        $group=$groupUser->getPermission[0]->group_name;
        return view('components.dashboard.sidebar', compact('menuWithPermission', 'group', 'user'));
    }
    
    
}
