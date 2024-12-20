<?php

namespace App\Http\Controllers;

use App\Http\Requests\CRUDRequest;
use App\Models\MenuItem;
use App\Models\PIC;
use App\Models\PT;
use App\Services\CRUDService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Combo;

class ClientandproductController extends _Controller
{
    protected $modulName = '';
    protected $_SETCORE = '';
    protected $list = '';
    protected $setFrom = '';
    protected $modelMaster = '';
    public function __construct()
    {
        $this->modulName = "clientandproduct";
        $this->modelMaster = "App\Models\ClientProduct";
       
        $cbo_pt = $this->_cbo(PT::class, ['id', 'nama'], true);
        $cbo_pic = $this->_cbo(PIC::class, ['id', 'nama'], true);
        $this->list = [
            [
                'field' => 'pt_id',
                'type' => 'select',
                'filter' => true,
                'position' => 'center',
                'showList' => true,
                'show' => true,
                'required' => true,
                'where' => null,
                'option' => $cbo_pt,
                'multiple' => false,
            ],
            [
                'field' => 'pic_id',
                'type' => 'select',
                'filter' => false,
                'position' => 'center',
                'show' => true,
                'showList' => false,

                'required' => true,
                'where' => null,
                'option' => $cbo_pic,
                'multiple' => false,
            ],
            [
                'field' => 'hp',
                'type' => 'number',
                'filter' => false,
                'position' => false,
                'show' => true,
                'showList' => true,

                'required' => true,
                'rules' => array(
                    0 => 'required',
                    1 => 'string',
                )
            ],
            [
                'field' => 'direktur',
                'type' => 'text',
                'filter' => false,
                'position' => false,
                'show' => true,
                'showList' => false,

                'required' => true,
                'rules' => array(
                    0 => 'required',
                    1 => 'string',
                )
            ],
            [
                'field' => 'product',
                'type' => 'text',
                'filter' => false,
                'position' => false,
                'show' => true,
                'showList' => true,

                'required' => true,
                'rules' => array(
                    0 => 'required',
                    1 => 'string',
                )
            ],
            [
                'field' => 'jenis',
                'type' => 'text',
                'filter' => false,
                'position' => false,
                'show' => true,
                'showList' => true,

                'required' => true,
                'rules' => array(
                    0 => 'required',
                    1 => 'string',
                )
            ],
            [
                'field' => 'spesifikasi',
                'type' => 'text',
                'filter' => false,
                'position' => false,
                'show' => true,
                'showList' => false,

                'required' => true,
                'rules' => array(
                    0 => 'required',
                    1 => 'string',
                )
            ],
            [
                'field' => 'sut',
                'type' => 'text',
                'filter' => false,
                'position' => false,
                'show' => true,
                'showList' => true,

                'required' => true,
                'rules' => array(
                    0 => 'required',
                    1 => 'string',
                )
            ],
            [
                'field' => 'merk',
                'type' => 'text',
                'filter' => false,
                'position' => false,
                'show' => true,
                'showList' => true,

                'required' => true,
                'rules' => array(
                    0 => 'required',
                    1 => 'string',
                )
            ],
            [
                'field' => 'code_hs',
                'type' => 'text',
                'filter' => false,
                'position' => false,
                'show' => true,
                'showList' => false,

                'required' => true,
                'rules' => array(
                    0 => 'required',
                    1 => 'string',
                )
            ],
            [
                'field' => 'status',
                'type' => 'radio',
                'filter' => true,
                'position' => 'center',
                'show' => true,
                'required' => false,
                'where' => null,
                'option' => $this->_cbo(Combo::class, ['id', 'data'], false, ['where' => [['f' => 'pid', 'v' => 'sts'], ['f' => 'categori', 'v' => 'sts']] ]),
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
