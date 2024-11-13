<?php

namespace App\Http\Controllers;

use App\Http\Requests\CRUDRequest;
use App\Models\MenuItem;
use App\Services\CRUDService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ComboController extends _Controller
{
    protected $modulName = '';
    protected $_SETCORE = '';
    protected $list = '';
    protected $setFrom = '';
    protected $modelMaster = '';
    public function __construct()
    {
        $this->modulName = "combo";
        $this->modelMaster = "App\Models\Icon";
        $option = [
            ['id' => 1, 'value' => 'Active'],
            ['id' => 2, 'value' => 'Non Acive'],
        ];

        $this->list = [
            [
                'field' => 'id',
                'type' => 'hidden',
                'filter' => false,
                'position' => false,
                'show' => false,
                'required' => true,
                'rules' => ['required', 'string']
            ],
            [
                'field' => 'nama',
                'type' => 'text',
                'filter' => false,
                'position' => false,
                'show' => true,
                'required' => true,
                'rules' => ['required', 'string']
            ],
            [
                'field' => 'data',
                'type' => 'text',
                'filter' => false,
                'position' => false,
                'show' => true,
                'required' => true,
                'rules' => ['required', 'string']
            ],
            [
                'field' => 'status',
                'type' => 'select',
                'filter' => true,
                'position' => 'center',
                'show' => true,
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
        $data['field'] = $this->getCombo($this->modelMaster, $this->list);
        $data['sessionOK'] = session('success');
        // $data['ses'] = ['success'=>session('success'),'failed'=>session('failed')];
        return view('pages.index', $data);
    }

    public function create()
    {
        $data = $this->_SETCORE;
        $data['list'] = array_merge($this->setFrom);
        $data['field'] = $this->getCombo($this->modelMaster, $this->list);
        $data['mode'] = 'add';
        return view('pages.index', $data);
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

     public function store(CRUDService $CRUDService, CRUDRequest $request)
     {
         $rules = [];
         foreach ($this->setFrom as $field) {
            if($field['show']){
                $fieldName = $field['field'];
                $rules[$fieldName] = $field['rules'];
            }
             
         }     
         $request->setRules($rules);
        return $CRUDService->create($request, $this->modelMaster, $this->setFrom, $this->modulName);
     }
     
     

    public function update(CRUDRequest $request, string $id, CRUDService $CRUDService)
    {
        $rules = [];
         foreach ($this->setFrom as $field) {
            if($field['show']){
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
