<?php

namespace App\Http\Middleware;

use App\Models\Groups;
use App\Models\Route;
use App\Models\GroupUsers;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response; 
use Illuminate\Support\Facades\DB; 

class RouteMiddleware
{  
public function handle($request, Closure $next)
{
    // Mendapatkan nama route saat ini
    $routeName = $request->route()?->getName();
    $routeParts = explode('.', $routeName);

    // Mendapatkan pengguna yang sedang login
    $user = Auth::user(); 
    
    if ($user) {
        // Mendapatkan grup pengguna
        $groupUser = GroupUsers::where('user_id', $user->id)->first();
        
        if ($groupUser) {
            // Memecah route menjadi bagian modul dan type
            if (count($routeParts) > 1) {
                $modul = $routeParts[0];
                $type = $routeParts[1];

                // Jika ada 3 bagian, update type
                if (count($routeParts) == 3) {
                    $type = $routeParts[2];
                }

                // Mencari menu yang sesuai dengan modul
                $menuItem = DB::table('menus')->where('url', $modul . '.index')->first();
                
                if ($menuItem) {
                    // Mengambil permission berdasarkan menu dan group
                    $permissions = DB::table('view_group_permissions')
                        ->where('menu_item_id', $menuItem->id)
                        ->where('id', $groupUser['group_id'])  
                        ->get();

                    // Debug: Periksa apakah ada permissions yang ditemukan
 
                    // Jika ada permissions yang ditemukan
                    if ($permissions->isNotEmpty()) {
 
                        // Jika type adalah 'index', ubah menjadi 'manage'
                        if ($type == 'index') {
                            $type = 'manage';
                        }
                        if ($type == 'updateStatus') {
                            $type = 'update';
                        }
                        if ($type == 'show') {
                            $type = 'view';
                        }
                         
                        $filteredPermissions = false;
                     
                        foreach ($permissions as $p) {
                            
                            if ($p->permission_type == $type) {
                                $filteredPermissions = true;
                                break;  
                            }
                        }
                        dd($type);
                         $GroupsName = Groups::where('id', $groupUser->group_id)->first();                        
                        if($GroupsName->name=="Administrator" && $type=="updateStatus" || $type=="updateTree" || $type=="updateOrder" || $type=="updateDov" || $type=="free"){
                            $filteredPermissions = true;

                        }
                         if ($filteredPermissions) {
                            return $next($request);
                        } else {
 
                             return redirect(RouteServiceProvider::NOACCESS)
                                ->with('failed', 'Anda tidak memiliki akses untuk modul ini!');
                        }
                    } else {
 
                        // Jika tidak ada permissions ditemukan untuk menu ini
                        return redirect(RouteServiceProvider::NOACCESS)
                            ->with('failed', 'Anda tidak memiliki akses untuk modul ini!');
                    }
                }
            }
        } else {
            // Jika tidak ditemukan grup pengguna
             return redirect(RouteServiceProvider::NOACCESS)
                ->with('failed', 'Grup pengguna tidak ditemukan!');
        }
    } else {
        // Jika pengguna tidak ditemukan (belum login)

        return $next($request);
        }
    return $next($request);
}


}