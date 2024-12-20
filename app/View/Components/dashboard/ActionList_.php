<?php

namespace App\View\Components\dashboard;

use App\Models\GroupUsers;
use App\Models\Menu;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\MenuGroup;
use App\Models\ViewGroupPermissions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ActionList extends Component
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
        $routeName = $request->route()?->getName();


        $routeParts = explode('.', $routeName);

        
        $user = Auth::user();
        $groupUser = GroupUsers::where('user_id', $user->id)
        ->with('getPermission.getMenuParent', 'getPermission.getMenuItems')
        ->first(); 
        $permissions = DB::table('view_group_permissions')
        ->where('menu_item_id', $menuItem->id)
        ->where('id', $groupUser['group_id'])  
        ->get();       
          return view('components.form.defult.actionHeader', compact('groupUser'));
    }
    
    
}
