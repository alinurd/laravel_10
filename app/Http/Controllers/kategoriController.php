<?php

namespace App\Http\Controllers;

use App\Http\Requests\CRUDRequest;
use App\Models\MenuItem;
use App\Services\CRUDService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class kategoriController extends _Controller
{
    protected $modulName = '';
    protected $_SETCORE = '';
    protected $list = '';
    protected $setFrom = '';
    protected $modelMaster = '';
    public function __construct()
    {
        $this->modulName = "docferify";
        $this->modelMaster = "App\Models\Combo";
        $option = [
            ['id' => 1, 'value' => 'Active'],
            ['id' => 2, 'value' => 'Non Acive'],
        ];
        $categori = [
            ['id' => "docferify", 'value' => 'Document Verify'], 
        ];
        $key1 = [];
        foreach (range('A', 'F') as $letter) {
            $key1[] = [
                'id' => $letter,
                'value' => $letter,
            ];
        }
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
                'field' => 'data',
                'type' => 'text',
                'filter' => false,
                'position' => false,
                'show' => true,
                'required' => true,
                'rules' => ['required', 'string']
            ],
            [
                'field' => 'key1',
                'type' => 'select',
                'filter' => true,
                'position' => 'center',
                'show' => true,
                'showList' => true,
                'required' => true,
                'where' => null,
                'option' => $key1,
                'multiple' => false,
            ],
            [
                'field' => 'categori',
                'type' => 'select',
                'filter' => true,
                'position' => 'center',
                'show' => true,
                'showList' => false,
                'required' => true,
                'where' => null,
                'option' => $categori,
                'multiple' => false,
            ],
            [
                'field' => 'status',
                'type' => 'radio',
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
        $where=[
            'where'=>['field'=>'categori', 'where'=>'kategori']
        ];
        $data['field'] = $this->getCombo($this->modelMaster,$where);
        $data['sessionOK'] = session('success');
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
        dd("jalan");
        $data = $this->_SETCORE;
        $data['list'] = array_merge($this->setFrom);
        $data['id'] = $id;
        $data['field'] = $this->modelMaster::find($id);
        $data['mode'] = 'show';
        return view('pages.index', $data);
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
