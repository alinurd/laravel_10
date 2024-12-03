<?php
namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('children')->whereNull('parent_id')->orderBy('position')->get();
        return view('menus.index', compact('menus'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|string',
            'icon' => 'nullable|string',
            'parent_id' => 'nullable|exists:menus,id',
            'position' => 'required|integer',
        ]);

        Menu::create($data);
        return back()->with('success', 'Menu created successfully!');
    }

    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|string',
            'icon' => 'nullable|string',
            'parent_id' => 'nullable|exists:menus,id',
            'position' => 'required|integer',
        ]);

        $menu->update($data);
        return back()->with('success', 'Menu updated successfully!');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return back()->with('success', 'Menu deleted successfully!');
    }
  
   
    
    public function updateOrder(Request $request)
{
    $data = $request->validate([
        'data' => 'required|array',
        'data.*.id' => 'required|exists:menus,id',
        'data.*.position' => 'required|integer',
        'data.*.parent_id' => 'nullable|exists:menus,id',
    ]);

    foreach ($data['data'] as $menuItem) {
        // Update posisi dan parent_id menu
        Menu::where('id', $menuItem['id'])->update([
            'position' => $menuItem['position'],
            'parent_id' => $menuItem['parent_id'],
        ]);
    }

    return response()->json(['success' => true]);
}


}
