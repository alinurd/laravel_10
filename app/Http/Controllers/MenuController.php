<?php
namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
  
 
public function index_()
{
    $menus = Menu::all();
    
    // Format data menjadi tree
    $tree = $this->buildTree($menus);
    
    $menus = Menu::with('children')->whereNull('parent_id')->orderBy('position')->get();
    return view('menus.index', compact('tree','menus'));
}public function index()
{
    // Ambil data menus dengan relasi children
    $menus = Menu::with('children')->whereNull('parent_id')->orderBy('position')->get();

    // Bangun tree dari data menus
    $tree = $this->buildTree($menus);
    // Kirim data ke view
    return view('menus.index', compact('tree','menus'));
}
private function buildTree_($menus, $parentId = null)
{
    $branch = [];
    foreach ($menus as $menu) {
        if ($menu->parent_id == $parentId) {
            // Rekursi untuk children
            $children = $this->buildTree($menus, $menu->id);

            // Tentukan ikon dan status berdasarkan status aktif menu
            $branch[] = [
                'id' => $menu->id,
                'text' => $menu->name,
                'icon' => $this->getIcon($menu), // Ikon berdasarkan status aktif
                'state' => $this->getState($menu), // Status kustom
                'children' => $children, // Menyertakan children yang sudah direkursi
            ];
        }
    }
    return $branch;
}
private function buildTree($menus, $parentId = null)
{
    $branch = [];
    foreach ($menus as $menu) {
        if ($menu->parent_id == $parentId) {
            // Rekursi untuk children, yang sudah ada dalam relasi 'children'
            $children = $this->buildTree($menu->children, $menu->id);

             $branch[] = [
                'id' => $menu->id,
                'text' => $menu->name,
                'icon' => $this->getIcon($menu), // Ikon berdasarkan status aktif
                'state' => $this->getState($menu), // Status kustom
                'children' => $children, // Menyertakan children yang sudah direkursi
            ];
        }
    }
    return $branch;
}


private function getIcon($menu)
{
    // Tentukan ikon berdasarkan status aktif
    return $menu->is_active == 1
        ? 'fa fa-check-circle text-success'  // Ikon untuk status aktif
        : 'fa fa-times-circle text-danger';  // Ikon untuk status tidak aktif
}

private function getState($menu)
{
    // Tentukan state berdasarkan nama atau status lainnya
    if ($menu->is_active == 1) {
        return ['selected' => true];  // Jika aktif, centang node
    } elseif ($menu->name == 'Expandable Menu') {
        return ['opened' => true];  // Jika menu jenis expandable, buka node
    } elseif ($menu->name == 'Disabled Menu') {
        return ['disabled' => true];  // Nonaktifkan node tertentu
    }
    return [];
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
        Menu::where('id', $menuItem['id'])->update([
            'position' => $menuItem['position'],
            'parent_id' => $menuItem['parent_id'],
        ]);
    }

    return response()->json(['success' => true]);
}

public function updateTree(Request $request)
{
    $request->validate([
        'id' => 'required|exists:menus,id',
        'parent_id' => 'nullable|exists:menus,id',
        'position' => 'required|integer',
    ]);

    // Update parent_id dan posisi
    $menu = Menu::find($request->id);
    $menu->parent_id = $request->parent_id;
    $menu->position = $request->position;
    $menu->save();

    return response()->json(['success' => true]);
}

public function updateStatus(Request $request)
{
    $menu = Menu::find($request->id);

    if ($menu) {
        $menu->is_active = $request->is_active;
        $menu->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }

    return response()->json(['success' => false, 'message' => 'Menu not found.']);
}


}
