<?php

namespace App\Http\Controllers;

use App\Http\Requests\CRUDRequest;
use App\Models\Bank;
use App\Models\ClientDokument;
use App\Models\Combo;
use App\Models\Kategori;
use App\Models\MenuItem;
use App\Services\CRUDService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
class TransaksiController extends _Controller
{
    protected $modulName = '';
    protected $_SETCORE = '';
    protected $list = '';
    protected $setFrom = '';
    protected $modelMaster = '';
    protected $cboDokument = '';
    public function __construct()
    {
        $this->modulName = "transaksi";
        $this->modelMaster = "App\Models\Transaksi";
        $cboRekening = $this->_cbo(
            Bank::class,
            ['id', DB::raw("CONCAT(nama, ': ', norek, ' - A/N ', an) AS data")],
            true,
            ['where' => [['f' => 'status', 'v' => '1']]]
        );
        $this->cboDokument = $this->_cbo(
            ClientDokument::class,
            ['id', DB::raw("CONCAT(kode, ' - ', jenis_product) AS data")],
            true,
            ['where' => [['f' => 'status', 'v' => '1']]]
        );
        $cboJenis = $this->_cbo(Combo::class, ['id', DB::raw("CONCAT(data) AS data")], true, ['where' => [['f' => 'categori', 'v' => 'jenisTransaksi'], ['f' => 'pid', 'v' => 'trans']] ]);
        $cboKategori = $this->_cbo(Kategori::class, ['id', DB::raw("CONCAT(nama) AS data")], true, ['where' => [['f' => 'status', 'v' => '1']] ]);

       $this->list = [

[        'field' => 'ref_dokument',
        'type' => 'select',
        'filter' => true,
        'position' => 'center',
        'showList' => true,
        'show' => false,
        'required' => false,
        'where' => null,
        'option' => $this->cboDokument,
        'multiple' => false,
       ],
            [
                'field' => 'tgl',
                'type' => 'date',
                'filter' => false,
                'position' => false,
                'show' => true,
                'required' => true,
                'rules' => array (0 => 'required',1 => 'string',)
            ],
            [
                'field' => 'jenis',
                'type' => 'select',
                'filter' => true,
                'position' => 'center',
                'show' => true,
                'required' => true,
                'where' => null,
                'option' => $cboJenis,
                'multiple' => false,
            ],
            [
                'field' => 'kategori',
                'type' => 'select',
                'filter' => true,
                'position' => 'center',
                'show' => true,
                'required' => true,
                'where' => null,
                'option' => $cboKategori,
                'multiple' => false,
            ],
            [
                'field' => 'nominal',
                'type' => 'number',
                'input' => 'rupiah',
                'filter' => false,
                'position' => false,
                'show' => true,
                'required' => true,
                'rules' => array (0 => 'required',1 => 'string',)
            ],
            [
                'field' => 'deks',
                'type' => 'textarea',
                'filter' => false,
                'position' => false,
                'show' => true,
                'required' => true,
                'rules' => array (0 => 'required',1 => 'string',)
            ],

            [
                'field' => 'file',
                'type' => 'file',
                'input' => 'file',
                'filter' => false,
                'position' => false,
                'show' => true,
                'required' => true,
                'rules' => array (0 => 'required',1 => 'string', 'file'=>['png, jpg, pdf'],)
            ],
            [
                'field' => 'rekening',
                'type' => 'select',
                'filter' => true,
                'position' => 'center',
                'show' => true,
                'required' => true,
                'where' => null,
                'option' => $cboRekening,
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
        $data['dataDokument']['cbo'] = $this->cboDokument;
        $data['dataDokument']["data"] = ClientDokument::all();
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
        $data['dataDokument']['cbo'] = $this->cboDokument;
        $data['dataDokument']["data"] = ClientDokument::all();
        return view('pages.index', $data);
    }

    /**
     * Update the specified resource in storage.
     */

     public function store(CRUDService $CRUDService, CRUDRequest $request)
     {
        $this->setFrom[] = [
            'label' => 'Referensi Dokumen',
            'field' => 'ref_dokument',
            'position' => 'center',
            'show' => true,
            'showList' => false,
            'required' => true,
            'filter' => true,
            'type' => 'text', // atau bisa "select", tergantung kebutuhan
            'option' => [],
            'input' => [],
            'multiple' => false,
            'rules' => ['required'], // atur sesuai validasi yang dibutuhkan
        ];
        
         $rules = [];
        //  dd($this->setFrom);
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
