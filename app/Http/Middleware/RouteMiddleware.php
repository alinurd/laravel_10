<?php

namespace App\Http\Middleware;

use App\Models\Route;
use App\Models\GroupUsers;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RouteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ambil data route yang diminta
        // $routes = Route::firstWhere('route', $request->route()?->getName());
        // $routeName = $request->route()?->getName();
    
        // // Ambil data user yang sedang login
        // $user = Auth::user();
    
        // // Ambil group terkait dengan user
        // $groupUser = GroupUsers::where('user_id', $user->id)->first();
    
        // // Ambil permission untuk group_user
        // $permissions = $groupUser->getPermission;
    
        // dd($routes);
        // // Cek jika route ada dan memiliki permission_name yang sesuai
        // if (blank($routes) || !$routes->status || !$request->user()->can($routes->permission_name)) {
        //     return "ikjwsdi";
        // }
    
        // // Logika untuk memastikan user memiliki 'manage' permission untuk route yang diminta
        // $hasPermission = false;
        // foreach ($permissions as $permission) {
        //     // Jika permission type adalah 'manage' dan route cocok
        //     if ($permission->permission_type === 'manage' && $permission->menu_item_route === $routeName) {
        //         $hasPermission = true;
        //         break;
        //     }
        // }
    
        // // Jika tidak ada permission yang sesuai, arahkan ke halaman home
        // if (!$hasPermission) {
        //     return 'ujdhowuhwuohd';
        // }
    
        // Jika user memiliki permission, lanjutkan request
        return $next($request);
    }
    
}
