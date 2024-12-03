<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use GuzzleHttp\Psr7\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
     public function index()
{
    $menus = Menu::whereNull('parent_id')->with('children')->orderBy('position')->get();
    return view('menu.menus', compact('menus'));
}

public function updateOrder(Request $request)
{
    $data = $request->input('data');

    foreach ($data as $index => $item) {
        $menu = Menu::find($item['id']);
        $menu->update([
            'parent_id' => $item['parent_id'],
            'position' => $index + 1,
        ]);

        if (!empty($item['children'])) {
            $this->updateChildOrder($item['children']);
        }
    }

    return response()->json(['message' => 'Menu order updated successfully!']);
}

private function updateChildOrder($children)
{
    foreach ($children as $index => $child) {
        $menu = Menu::find($child['id']);
        $menu->update([
            'parent_id' => $child['parent_id'],
            'position' => $index + 1,
        ]);

        if (!empty($child['children'])) {
            $this->updateChildOrder($child['children']);
        }
    }
}



}
