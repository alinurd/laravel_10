<?php

namespace App\Http\Controllers;

use App\Http\Requests\CRUDRequest;
use App\Models\Kriterium;
use App\Models\MenuItem;
use App\Models\SubKriteria;
use App\Services\CRUDService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class KriteriaController extends _Controller
{
    protected $modulName = '';
    protected $_SETCORE = '';
    protected $list = '';
    protected $setFrom = '';
    protected $modelMaster = '';
    public function __construct()
    {
        $this->modulName = "kriterium";
        $this->modelMaster = "App\Models\Kriterium";
        $sts = [
            ['id' => 1, 'value' => 'Active'],
            ['id' => 2, 'value' => 'Non Acive'],
        ];
        $atribut = [
            ['id' => 1, 'value' => 'Cost'],
            ['id' => 2, 'value' => 'Benifit'],
        ];

       $this->list = [

            [
                'field' => 'kode',
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
                'field' => 'atribut',
                'type' => 'radio',
                'filter' => true,
                'position' => 'center',
                'show' => true,
                'required' => true,
                'where' => null,
                'option' => $atribut,
                'multiple' => false,
            ],
            [
                'field' => 'bobot',
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
                'required' => false,
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
        $data['mode'] = 'add'; ;
        $data['costum'] =[
            'data'=>false,
            'page'=>'subKategori',
         ];

        return view('pages.index', $data);
    }



    public function show(string $id)
    {
        $data = $this->_SETCORE;
        $data['list'] = array_merge($this->setFrom);
        $data['id'] = $id;
        $data['field'] = $this->modelMaster::find($id);
        $data['mode'] = 'show';
        $data['costum'] =[
            'data'=>$this->getCombo("App\Models\SubKriteria", ['where' => ['field' => 'kriteria_id', 'where' => $id]]),
            'page'=>'subKategori',
         ];
 

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
  $data['costum'] =[
            'data'=>$this->getCombo("App\Models\SubKriteria", ['where' => ['field' => 'kriteria_id', 'where' => $id]]),
            'page'=>'subKategori',
         ];
        return view('pages.index', $data);
    }

      public function store(CRUDService $CRUDService, CRUDRequest $request)
{ 
    $arrSubKriteria = [];
  
    $rawSub = $request->input('SubKriteria', []);
    $namaList  = $rawSub["nama"] ?? [];
    $ketList   = $rawSub["ket"] ?? [];
    $nilaiList = $rawSub["nilai"] ?? [];

    foreach ($namaList as $i => $val) {
        $arrSubKriteria[] = [
            'nama'  => $val,
            'ket'   => $ketList[$i] ?? null,
            'nilai' => $nilaiList[$i] ?? null,
        ];
    }  
    $record = Kriterium::create([
        'kode'    => $request->kode,
        'nama'    => $request->nama,
        'atribut' => $request->atribut,
        'bobot'   => $request->bobot,
        'status'  => 1,
    ]);

    // Ambil ID Kriteria
    $kriteriaId = $record->id ?? null;

    // Simpan data SubKriteria
    if ($kriteriaId && !empty($arrSubKriteria)) {
        foreach ($arrSubKriteria as $item) {
            SubKriteria::create([
                'kriteria_id' => $kriteriaId,
                'nama'        => $item['nama'],
                'ket'         => $item['ket'],
                'nilai'       => $item['nilai'],
            ]);
        }
    }

return redirect()->route('kriterium.edit', $kriteriaId)->with('success', 'Data Created successfully!');
}
public function update(CRUDRequest $request, string $id, CRUDService $CRUDService)
{
    // Ambil data Kriteria yang ingin diupdate
    $kriteria = Kriterium::findOrFail($id);

    // Ambil dan siapkan data SubKriteria dari request
    $arrSubKriteria = []; 
    $rawSub = $request->input('SubKriteria', []);
    $idList     = $rawSub['id']    ?? [];
    $namaList   = $rawSub['nama']  ?? [];
    $ketList    = $rawSub['ket']   ?? [];
    $nilaiList  = $rawSub['nilai'] ?? [];

    foreach ($namaList as $i => $val) {
        $arrSubKriteria[] = [
            'id'     => $idList[$i]   ?? null,
            'nama'   => $val,
            'ket'    => $ketList[$i]  ?? null,
            'nilai'  => $nilaiList[$i] ?? null,
        ];
    }

    // Update data Kriteria
    $kriteria->update([
        'kode'    => $request->kode,
        'nama'    => $request->nama,
        'atribut' => $request->atribut,
        'bobot'   => $request->bobot,
        'status'  => $request->status ?? 1,
    ]);

    // Update atau Insert SubKriteria
    foreach ($arrSubKriteria as $item) {
        if (!empty($item['id'])) {
            // Update berdasarkan ID
            SubKriteria::where('id', $item['id'])
                ->where('kriteria_id', $kriteria->id)
                ->update([
                    'nama'  => $item['nama'],
                    'ket'   => $item['ket'],
                    'nilai' => $item['nilai'],
                ]);
        } else {
            // Insert baru
            SubKriteria::create([
                'kriteria_id' => $kriteria->id,
                'nama'        => $item['nama'],
                'ket'         => $item['ket'],
                'nilai'       => $item['nilai'],
            ]);
        }
    }

    return redirect()->route('kriterium.edit', $id)
        ->with('success', 'Data berhasil diperbarui!');
}




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, CRUDService $CRUDService)
    {
        return $CRUDService->delete($id, $this->modelMaster, $this->modulName);
    }
}
