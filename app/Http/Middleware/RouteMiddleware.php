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
    public function handle(Request $request, Closure $next): Response
    { 
        $routeName = $request->route()?->getName();
         $routeParts = explode('.', $routeName);

         $user = Auth::user(); 
        //  if($user){
        //     $groupUser = GroupUsers::where('user_id', $user->id)->first();
        //     if (count($routeParts) > 1) { 
        //         $modul = $routeParts[0];
        //         $type = $routeParts[1];
        //         if(count($routeParts)==3){
        //             $type = $routeParts[2];
        //         }
        //         $menuItem = \DB::table('menu_items')->where('modul', $modul)->first();
        //         if ($menuItem) {
        //             $permissions = \DB::table('view_group_permissions')
        //             ->where('menu_item_id', $menuItem->id)
        //             ->where('id', $groupUser->group_id)  
        //             ->get(); 
 
        //             if ($permissions->isNotEmpty()) {
        //                  if($type=='index'){
        //                     $type='manage';
        //                 }
        //                  $filteredPermissions=false;
        //                 foreach($permissions as $p){
        //                     if($p->permission_type==$type){
        //                         $filteredPermissions=true;
        //                     }
        //                 }  
        //                 // dd($filteredPermissions);

        //                 if ($filteredPermissions==true) {
        //                     return $next($request);
        //                 } else {
        //                     return redirect(RouteServiceProvider::NOACCESS)->with('failed', 'Anda tidak memiliki akses untuk modul ini!');
        //                 }
        //             } else {
        //                 return redirect(RouteServiceProvider::NOACCESS)->with('failed', 'Anda tidak memiliki izin untuk menu ini!');
        //             }
        //         } else {
        //             return $next($request);
        //             // return redirect(RouteServiceProvider::NOTFOUND)->with('failed', 'Modul tidak ditemukan!');
        //         }
        //     }
        //  }else{
        //     return $next($request);
        // }
        return $next($request);

     }

}