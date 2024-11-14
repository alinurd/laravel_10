<?php

namespace App\Http\Controllers;

use App\Http\Requests\CRUDRequest;
use App\Models\MenuGroup;
use App\Models\MenuItem;
use App\Models\ViewGroupPermissions;
use App\Services\CRUDService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class GroupController extends _Controller
{
    protected $modulName = '';
    protected $_SETCORE = '';
    protected $list = '';
    protected $setFrom = '';
    protected $modelMaster = '';
    protected $groups = '';
    public function __construct()
    {
        $this->modulName = "group";
        $this->modelMaster = "App\Models\GroupUsers";
        $this->groups = "App\Models\Groups";
        $option = [
            ['id' => 1, 'value' => 'Active'],
            ['id' => 2, 'value' => 'Non Acive'],
        ];

        $this->list = [

            [
                'field' => 'id',
                'type' => 'text',
                'filter' => false,
                'position' => 'center',
                'show' => false,
                'required' => true,
                'rules' => array(
                    0 => 'required',
                    1 => 'string',
                )
            ],
            [
                'field' => 'group_name',
                'type' => 'text',
                'filter' => false,
                'position' => 'center',
                'show' => true,
                'required' => true,
                'rules' => array(
                    0 => 'required',
                    1 => 'string',
                )
            ],

            [
                'field' => 'user_count',
                'type' => 'text',
                'filter' => false,
                'position' => 'center',
                'show' => false,
                'required' => true,
                'rules' => array(
                    0 => 'required',
                    1 => 'string',
                )
                ],
                [
                    'field' => 'status',
                    'type' => 'select',
                    'filter' => true,
                    'position' => 'center',
                    'show' => false,
                    'required' => false,
                    'where' => null,
                    'option' => $option,
                    'multiple' => false,
                ],
        ];

        $this->setFrom = $this->_SETDATALIST(['list' => $this->list], $this->modulName);

        $this->_SETCORE = $this->_SETCORE($this->modulName);
    }

    public function index()
    {
        $data = $this->_SETCORE;
        $data['list'] = array_merge($this->setFrom);
        $data['field'] = $this->getDataGroup($this->modelMaster, $this->list);
        // dd($data['field']);
        $data['sessionOK'] = session('success');
        // $data['ses'] = ['success'=>session('success'),'failed'=>session('failed')];
        $data['menuGroup'] = MenuGroup::with('menuItems')->get();
        return view('pages.system.group_index', $data);
    }

    public function create()
    {
        $data = $this->_SETCORE;
        $data['list'] = array_merge($this->setFrom);
        $data['field'] = $this->getDataGroup($this->modelMaster, $this->list);
        $data['mode'] = 'add';
        $data['stm'] = true;
        $data['menuGroup'] = MenuGroup::with('menuItems')->get();
        return view('pages.system.group_index', $data);
    }



    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = $this->_SETCORE;
        $data['list'] = array_merge($this->setFrom);
        $data['id'] = $id;
        $data['field'] = ViewGroupPermissions::where('id', $id)->get();
 
            $xx = ViewGroupPermissions::where('id', $id)
        ->select(
            'id',
            'group_name',
            'menu_item_name',
            'menu_item_route',
            'menu_parent',
            'menu_item_id',
            'menu_group_id',
            \DB::raw("GROUP_CONCAT(permission_type SEPARATOR ',') as permission_types")
        )
        ->groupBy(
            'id',
            'group_name',
            'menu_item_name',
            'menu_group_id',
            'menu_parent',
            'menu_item_id'
        )
        ->get();

        $result = [];
        foreach ($xx as $item) {
            $permissionArray = explode(',', $item->permission_types);
            $result[] = [
                'id' => $item->id,
                'group_name' => $item->group_name,
                'menu_item_id' => $item->menu_item_id,
                'menu_item_name' => $item->menu_item_name,
                'menu_group_id' => $item->menu_group_id,
                'menu_parent' => $item->menu_parent,
                'permission_types' => [
                    'create' => in_array('create', $permissionArray) || in_array('store', $permissionArray),
                    'store' => in_array('create', $permissionArray) || in_array('store', $permissionArray),

                    'destroy' => in_array('destroy', $permissionArray) || in_array('delete', $permissionArray),
                    'delete' => in_array('destroy', $permissionArray) || in_array('delete', $permissionArray),
        
                    'update' => in_array('update', $permissionArray) || in_array('edit', $permissionArray),
                    'edit' => in_array('update', $permissionArray) || in_array('edit', $permissionArray),

                    'view' => in_array('view', $permissionArray),
                    'manage' => in_array('manage', $permissionArray),
                ],
            ];
        }


         $data['groupPermission'] = $result;
         $data['mode'] = 'edit';
        $data['stm'] = true;

        $data['menuGroup'] = MenuGroup::with('menuItems')->with('getAccessMenuItems')->get();
 
        return view('pages.system.group_index', $data);
        }

    /**
     * Update the specified resource in storage.
     */

     public function store(Request $request)
     {
          DB::beginTransaction();
         try {
             $groupId = Str::uuid();
             DB::table('groups')->insert([
                 'id' => $groupId,
                 'guard_name' => 'web',
                 'name' => $request->input('group_name'),
              ]);
     
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
             return redirect()->route('group.index')->with('success', 'Role berhasil disimpan.');
         } catch (\Exception $e) {
             DB::rollback();
             dd( $e);
             return redirect()->back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
         }
     }



    public function update(CRUDRequest $request, string $id, CRUDService $CRUDService)
    {
        $rules = [];
        foreach ($this->setFrom as $field) {
            if ($field['show']) {
                $fieldName = $field['field'];
                $rules[$fieldName] = $field['rules'];
            }
        }
        $request->setRules($rules);
        return $CRUDService->update($id, $request, $this->modelMaster, $this->setFrom, $this->modulName);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, CRUDService $CRUDService)
    {
        return $CRUDService->delete($id, $this->groups, $this->modulName);
    }
}
