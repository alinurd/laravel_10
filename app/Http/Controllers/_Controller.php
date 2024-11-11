<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Combo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

class _Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function setLanguage($locale)
    {
        App::setLocale($locale);
    }
    
    public function _getLang($m, $l)
    {
        return __($m . '.' . $l);
    }
    
    public function _base($mdl="")
    {
        
        $currentRoute = Route::current();
        $alias = $currentRoute->getName();
        $menuItem = MenuItem::where('route', $alias)->first();   
      
        return [
            'currentRoute' => $mdl ?? $currentRoute->uri,            
            'route' => $currentRoute->getActionName(),
            'menuParent' => $menuItem ? $menuItem->menuGroup->name : null,
        ];
    }
    
    public function _SETCORE($mdl)
    {
        $base = $this->_base($mdl);  
      

        return [
            'title' => $this->_getLang($base['currentRoute'], 'title') ?: $base['currentRoute'],
            'page' => $this->_getLang($base['currentRoute'], 'page') ?: $base['currentRoute'],
            'menuParent' => $base['menuParent'],
            'route' => $base['route'],
            'list' => $base['route'],
            'currentRoute' => $base['currentRoute'],
        ];
    }
    
    public function _SETDATALIST($d = [], $mdl)
    {
        // dd($d);
        $base = $this->_base($mdl);  
         $newData = [];
         foreach ($d['list'] as $item) {
             if (isset($item)) {
                if($item['filter']==true){
                }
                 $newData[] = [
                    'label'  => strtoupper($this->_getLang($base['currentRoute'],'fld_'.$item['field'])?:'fld'.$item['field']),
                    'field' => strtolower($item['field']),
                    'position' => strtolower($item['position']), 
                    'show' => $item['show'],
                    'required' => $item['required'],
                    'type' => $item['type'],
                ];
            }
        }
    
        // Return the modified list
        return $newData;
    }
    
    public function getCombo()
    {
        $p= Combo::all();
        return $p;
    }
    
}
