<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Models\MenuGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = Role::query()
            ->when(!blank($request->search), function ($query) use ($request) {
                return $query
                    ->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('guard_name', 'like', '%' . $request->search . '%');
            })
            ->with('permissions', function ($query) {
                return $query->select('id', 'name');
            })
            ->orderBy('name')
            ->paginate(10);
        $permissions = Permission::orderBy('name')->get();
        $menuGroup = MenuGroup::with('menuItems')->get();
         return view('role.index', compact('roles', 'permissions', 'menuGroup'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // Simpan data group (role)
            $groupId = Str::uuid();
            DB::table('groups')->insert([
                'id' => $groupId,
                'guard_name' => $request->input('guard_name'),
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);
    
            // Simpan data permissions untuk setiap tipe permission
            $permissions = ['manage', 'create', 'update', 'delete', 'view'];
            foreach ($permissions as $permissionType) {
                if ($request->has($permissionType)) {
                    foreach ($request->input($permissionType) as $menuGroupId => $items) {
                        foreach ($items as $menuItemId => $value) {
                            DB::table('group_permissions')->insert([
                                'id' => Str::uuid(),
                                'group_id' => $groupId,
                                'permission_type' => $permissionType,
                                'menu_item_id' => $menuItemId,
                            ]);
                        }
                    }
                }
            }
    
            DB::commit();
            return redirect()->route('role.index')->with('success', 'Role berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('role.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('role.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRoleRequest $request, Role $role)
    {
        return $role->update($request->validated())
            && $role->syncPermissions(!blank($request->permissions) ? $request->permissions : array())
            ? back()->with('success', 'Role has been updated successfully!')
            : back()->with('failed', 'Role was not updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        return $role->delete()
            ? back()->with('success', 'Role has been deleted successfully!')
            : back()->with('failed', 'Role was not deleted successfully!');
    }
}
