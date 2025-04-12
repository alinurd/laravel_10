<?php

namespace App\Http\Controllers;

use App\Http\Requests\CRUDRequest;
use App\Models\Chart;
use App\Models\ChartConfig;
use App\Models\MenuItem;
use App\Models\Transaksi;
use App\Services\CRUDService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class ChartdetailController extends _Controller
{
    protected $modulName = '';
    protected $_SETCORE = '';
    protected $list = '';
    protected $setFrom = '';
    protected $modelMaster = '';
    protected $cboType = '';
    protected $cboSts = '';
    protected $cboJenis = '';
    public function __construct()
    {
        $this->modulName = "chacrtdetail";
        $this->modelMaster = "App\Models\ChartDetail";
        $this->cboSts = [
            ['id' => 1, 'value' => 'Aktif'],
            ['id' => 2, 'value' => 'Tidak Aktif'],
        ];
        $this->cboType = [
            ['id' => "line", 'value' => 'Line'],
            ['id' => "bar", 'value' => 'Bar'],
            ['id' => "polarArea", 'value' => 'Polar Area'],
            ['id' => "doughnut", 'value' => 'Doughnut'],
        ];
        // ['id', DB::raw("CONCAT(nama, ': ', norek, ' - A/N ', an) AS data")],

        $this->cboJenis = $this->_cbo(Chart::class, ['id', DB::raw("CONCAT(name, ' - ', jenis) AS data")], true,);
        // $this->list = [];
        $this->list = [
            [
                'field' => 'type',
                'type' => 'select',
                'filter' => true,
                'position' => false,
                'showList' => true,
                'show' => false,
                'required' => true,
                'where' => null,
                'option' => $this->cboType,
                'multiple' => false,
            ],
            [
                'field' => 'chart_id',
                'type' => 'select',
                'filter' => true,
                'position' => false,
                'showList' => true,
                'show' => false,
                'required' => true,
                'where' => null,
                'option' => $this->cboJenis,
                'multiple' => false,
            ],
            [
                'field' => 'judul',
                'type' => 'text',
                'filter' => false,
                'position' => false,
                'showList' => true,
                'show' => false,
                'required' => true,
                'rules' => array(
                    0 => 'required',
                    1 => 'string',
                )
            ],
           
            [
                'field' => 'label',
                'type' => 'text',
                'filter' => false,
                'position' => false,
                'showList' => true,
                'show' => false,
                'required' => true,
                'rules' => array(
                    0 => 'required',
                    1 => 'string',
                )
            ],
            
            [
                'field' => 'fill',
                'type' => 'text',
                'filter' => false,
                'position' => false,
                'showList' => false,
                'show' => false,
                'required' => true,
                'rules' => array(
                    0 => 'required',
                    1 => 'string',
                )
            ],
            [
                'field' => 'tension',
                'type' => 'text',
                'filter' => false,
                'position' => false,
                'showList' => false,
                'show' => false,
                'required' => true,
                'rules' => array(
                    0 => 'required',
                    1 => 'string',
                )
            ]
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
        $x= ChartConfig::generateChrat(); 
        $f['form']['cboSts']=$this->cboSts;
        $f['form']['cboType']=$this->cboType;
        $f['form']['cboJenis']=$this->cboJenis;
           $data['costum'] = ["chart", $x, $f];
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
        dd($request);
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
