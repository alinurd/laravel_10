<?php

namespace App\Http\Controllers;

use App\Http\Requests\CRUDRequest;
use App\Models\MenuGroup;
use App\Models\MenuItem;
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
    public function __construct()
    {
        $this->modulName = "group";
        $this->modelMaster = "App\Models\GroupUsers";
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
                'show' => true,
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
        $data['field'] = $this->modelMaster::find($id);
        $data['mode'] = 'edit';
        return view('pages.index', $data);
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
                //  'description' => $request->input('description'),
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
        return $CRUDService->delete($id, $this->modelMaster, $this->modulName);
    }
}
