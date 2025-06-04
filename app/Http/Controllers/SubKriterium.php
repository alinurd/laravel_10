<?php

namespace App\Http\Controllers;

use App\Http\Requests\CRUDRequest;
use App\Models\Kriterium;
use App\Models\MenuItem;
use App\Services\CRUDService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class SubKriterium extends _Controller
{
    protected $modulName = '';
    protected $_SETCORE = '';
    protected $list = '';
    protected $setFrom = '';
    protected $modelMaster = '';
    public function __construct()
    {
        $this->modulName = "subKriterium";
        $this->modelMaster = "App\Models\Icon";
          
        
                $cboKriterium = $this->_cbo(Kriterium::class, ['id', DB::raw("CONCAT(kode, ' - ', nama) AS data")], true,); 


        $sts = [
            ['id' => 1, 'value' => 'Active'],
            ['id' => 2, 'value' => 'Non Acive'],
        ];

        $this->list = [

             [
                'field' => 'kriteria_id',
                'type' => 'select',
                'filter' => true,
                'position' => 'center',
                'showList' => true,
                'show' => true,
                'required' => true,
                'where' => null,
                'option' => $cboKriterium,
                'multiple' => false,
            ],
 
            [
                'field' => 'nama',
                'type' => 'text',
                'filter' => false,
                'position' => false,
                'show' => true,
                'required' => true,
                'rules' => array(
                    0 => 'required',
                    1 => 'string',
                )
            ],
            [
                'field' => 'keterangan',
                'type' => 'text',
                'filter' => false,
                'position' => false,
                'show' => true,
                'required' => true,
                'rules' => array(
                    0 => 'required',
                    1 => 'string',
                )
            ],
            [
                'field' => 'nilai',
                'type' => 'number',
                'filter' => false,
                'position' => false,
                'show' => true,
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
                'required' => true,
                'where' => null,
                'option' => $sts,
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
        $data['costum'] = $this->getCombo("App\Models\Combo", ['where' => ['field' => 'categori', 'where' => 'docferify']]);
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
            if ($field['show']) {
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
