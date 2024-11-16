<?php

namespace App\View\Components\dashboard;

use App\Models\GroupUsers;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Topbar extends Component
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
         return view('components.dashboard.topbar', [
            'user' => auth()->user(),
            'group' => $groupUser->getPermission[0]->group_name,
        ]);
    }
}
