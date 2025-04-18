<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Combo;
use App\Models\GroupUsers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use InvalidArgumentException;

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
        $menuItem = MenuItem::where('route', $alias)->with('getMenuParent')->first();   
         return [
            'currentRoute' => $mdl ?? $currentRoute->uri,            
            'route' => $currentRoute->getActionName(),
            'menuParent' => $menuItem ? $menuItem->menuGroup->name : null,
            'parentName' => isset($menuItem['getMenuParent']['parent_name']) && $menuItem['getMenuParent']['parent_name']!='Main' ? $menuItem['getMenuParent']['parent_name'] : "Home",
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
            'parentName' => $base['parentName'],
        ];
    }
    
    public function _SETDATALIST($d = [], $mdl)
    {
        // dd($d);
        $base = $this->_base($mdl);  
         $newData = [];
         foreach ($d['list'] as $item) {
             if (isset($item)) {
                 $newData[] = [
                    'label' => ucfirst(strtolower($this->_getLang($base['currentRoute'], 'fld_'.$item['field']) ?: 'fld'.$item['field'])),
                    'field' => strtolower($item['field']),
                    'position' => strtolower($item['position']), 
                    'show' => isset($item['show']) ? $item['show'] : false,
                    'showList' => isset($item['showList']) ? $item['showList'] :$item['show'] ,
                    'required' => isset($item['required']) ? $item['required'] : false,
                    'filter' => isset($item['filter']) ? $item['filter'] : false,
                    'type' => isset($item['type']) ? $item['type'] : false,
                    'option' => isset($item['option']) ? $item['option'] : [],
                    'input' => isset($item['input']) ? $item['input'] : [],
                    'multiple' => isset($item['multiple']) && $item['multiple'] == true,
                    'rules' => isset($item['rules']) ? $item['rules'] : [],
                ];
            }
        }
    
        // Return the modified list
        return $newData;
    }
    

    
    public function getDataGroup($model = '', $con = [])
{
    $groupUsers = new GroupUsers(); 
    $groupUserCounts = $groupUsers->getCountByUser();
    $p = []; 
    foreach ($groupUserCounts as $groupUser) {
        $p[] = [
          'id' => $groupUser->group_id,
          'group_name' => $groupUser->group_name,
          'user_count' => $groupUser->user_count
      ]; 
    }
    
    return $p;
}



    public function getCombo($model='', $con=[])
    {
        $p = $model::query();
        if ($con) {
            foreach ($con as $item) {
                 if (isset($item['where']) && !empty($item['where'])) {
                     $p = $p->where($item['field'], '=', $item['where']);
                }
            }
        }
        $p = $p->orderBy('id', 'desc')->get();
                
         return $p;
    }  
    
    public function _cbo($model, $fields, $includeEmpty = false, $cons = []) {
        // Validate the fields parameter
        if (!is_array($fields) || count($fields) < 2) {
            throw new InvalidArgumentException("Fields harus berupa array dengan minimal 2 elemen.");
        }
    
         $query = $model::query();
    
         if (isset($cons['where']) && !empty($cons['where'])) {
            foreach ($cons['where'] as $item) {
                 if (isset($item['f']) && isset($item['v']) && !empty($item['f']) && !empty($item['v'])) {
                    $query->where($item['f'], '=', $item['v']);
                }
            }
        }
     
        $sql = $query->toSql();
        $bindings = $query->getBindings();
        $finalQuery = vsprintf(str_replace('?', '%s', $sql), $bindings);
     
        $data = $query->select($fields)->get();
     $dropdown = $data->map(function ($item) use ($fields) {
    return [
        'id' => $item->{$fields[0]},
        'value' => $item->data // Sesuaikan dengan alias yang digunakan
    ];
})->toArray();

        // $dropdown = $data->map(function ($item) use ($fields) {
        //     return [
        //         'id' => $item->{$fields[0]},
        //         'value' => $item->{$fields[1]}
        //     ];
        // })->toArray();
    
        // Optionally add an empty "Pilih Opsi" option at the top
        if ($includeEmpty) {
            array_unshift($dropdown, ['id' => '', 'value' => '- Pilih -']);
        }
    
        // Return the resulting dropdown array
        return $dropdown;
    }
    
    
    
    
    
}
