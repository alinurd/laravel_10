<?php

namespace App\View\Components\dashboard;

use App\Models\GroupUsers;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class ActionHeader1 extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct( 
        private string $currentRoute, 
        private string $mode, 
    )
    {
    
        $this->currentRoute = $currentRoute;
        $this->mode = $mode;
       
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        $user = Auth::user();
        $groupUser = GroupUsers::where('user_id', $user->id)
        ->with('getPermission.getMenuParent', 'getPermission.getMenuItems')
        ->first(); 

        $permissions = DB::table('view_group_permissions')
        ->select('permission_type as type')
        ->where('menu_item_route', $this->currentRoute.'.index')
        ->where('id', $groupUser['group_id'])  
        ->get();
        return view('components.dashboard.action-header-1', [ 
            'canCreate' => $permissions->contains('type', 'create'),
            'canDelete' => $permissions->contains('type', 'destroy'),
            'canView' => $permissions->contains('type', 'view'), 
            'canEdit' => $permissions->contains('type','edit'), 
            'canPrint' => $permissions->contains('type','manage'), 
            'currentRoute' => $this->currentRoute, 
            'mode' => $this->mode, 
        ]);
    }
}
