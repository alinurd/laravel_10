<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
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
        return $m && $l ? __($m . '.' . $l) : __('global.notdefinis');
    }
    
    public function _base()
    {
        $currentRoute = Route::current();
        $alias = $currentRoute->getName();
        $menuItem = MenuItem::where('route', $alias)->first();    
        return [
            'currentRoute' => $currentRoute->uri,
            'route' => $currentRoute->getActionName(),
            'menuParent' => $menuItem ? $menuItem->menuGroup->name : null,
        ];
    }
    
    public function _SETCORE()
    {
        $base = $this->_base();    
        return [
            'title' => $this->_getLang($base['currentRoute'], 'title') ?: $base['currentRoute'],
            'page' => $this->_getLang($base['currentRoute'], 'page') ?: $base['currentRoute'],
            'menuParent' => $base['menuParent'],
            'route' => $base['route'],
        ];
    }
    
}
