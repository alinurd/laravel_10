<?php

namespace App\Http\Controllers;

use App\Http\Requests\CRUDRequest;
use App\Models\DocFerifyDetail;
use App\Models\DocFerifyHeader;
use App\Models\MenuItem;
use App\Services\CRUDService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Isset_;

class DocumenctferifyController extends _Controller
{
    protected $modulName = '';
    protected $_SETCORE = '';
    protected $list = '';
    protected $setFrom = '';
    protected $modelMaster = '';
    public function __construct()
    {
        $this->modulName = "documenctferify";
        $this->modelMaster = "App\Models\DocFerifyHeader";
        $option = [
            ['id' => 1, 'value' => 'Active'],
            ['id' => 2, 'value' => 'Non Acive'],
        ];

        $this->list = [

            [
                'field' => 'pic',
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
                'field' => 'jenis_product',
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
        $data['costum'] = $this->getCombo( "App\Models\Combo",[ 'where'=>['field'=>'categori', 'where'=>'docferify']]);
        return view('pages.index', $data);
    }

    public function create()
    {
        $data = $this->_SETCORE;
        $data['list'] = array_merge($this->setFrom); 

        $data['field'] = $this->getCombo($this->modelMaster, $this->list);
        $data['mode'] = 'add';
        $data['costum'] = $this->getCombo( "App\Models\Combo",[ 'where'=>['field'=>'categori', 'where'=>'docferify']]);
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
        $header = $this->modelMaster::find($id);
        $details = $header->getDetails; 
        $data['field'] = $header;
        $data['dataDetail'] = $details;
        $data['mode'] = 'edit';
        $data['costum'] = $this->getCombo( "App\Models\Combo",[ 'where'=>['field'=>'categori', 'where'=>'docferify']]);

        return view('pages.index', $data);
    }

    /**
     * Update the specified resource in storage.
     */

    public function store(CRUDService $CRUDService, CRUDRequest $request)
    {
        DB::beginTransaction();
    
        try {
            // Simpan header
            $headerData = $request->only(['pic', 'jenis_product', 'nilai']);
            $headerData['status'] = true;
            $header = DocFerifyHeader::create($headerData);
            $id_doc_ferify = $header->id;
            $customData = $request->input('custom'); 
             if ($customData) {
                $cName = $customData['cName']; 
                foreach ($cName as $key) {  
                    if (isset($customData[$key])) {  
                        $fields = $customData[$key];  
                        $count = count($fields['Uraian']);
                        for ($index = 0; $index < $count; $index++) {  
                            DocFerifyDetail::create([
                                'id_doc_ferify' => $id_doc_ferify,
                                'pid' => $key,
                                'uraian' => $fields['Uraian'][$index] ?? null,
                                'dos' => !empty($fields['DOS'][$index]) ? date('Y-m-d', strtotime($fields['DOS'][$index])) : null,
                                'ket' => $fields['Ket'][$index] ?? null,
                                'dov' => !empty($fields['DOV'][$index]) ? date('Y-m-d', strtotime($fields['DOV'][$index])) : null,
                                'status' => true,
                            ]);
                        }
                    }
                }
            }
            DB::commit();
            return redirect()->route('documenctferify.index')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->withErrors('Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }
    
     
     

    public function update(CRUDRequest $request, string $id, CRUDService $CRUDService)
    {
        DB::beginTransaction();
 
        try { 
            $header = DocFerifyHeader::findOrFail($id);
             
            $headerData = $request->only(['pic', 'jenis_product', 'nilai']);
            $headerData['status'] = true;
     
            $header->update($headerData);
     
            $customData = $request->input('custom'); 
    
            if ($customData) {
                $cName = $customData['cName'];  
                foreach ($cName as $key) {  
                    if (isset($customData[$key])) {  
                        $fields = $customData[$key];  
                        $count = count($fields['Uraian']);
                           
                        for ($index = 0; $index < $count; $index++) { 
                            $idDetail = $fields['id'][$index] ?? null;
                            $existingDetail = DocFerifyDetail::where('id', $idDetail)
                            ->first(); 
                            $data = [
                                'id_doc_ferify' => $id,
                                'pid' => $key,
                                'uraian' => $fields['Uraian'][$index] ?? null,
                                'dos' => !empty($fields['DOS'][$index]) ? date('Y-m-d', strtotime($fields['DOS'][$index])) : null,
                                'ket' => $fields['Ket'][$index] ?? null,
                                'dov' => !empty($fields['DOV'][$index]) ? date('Y-m-d', strtotime($fields['DOV'][$index])) : null,
                                'status' => true,
                            ];

                                if ($existingDetail) {
                                    $existingDetail->update($data);
                                } else { 
                                    DocFerifyDetail::create($data);
                                } 
                        }
                    }
                }
            }
            
            DB::commit();
            return redirect()->route('documenctferify.index')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->withErrors('Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, CRUDService $CRUDService)
    {
        return $CRUDService->delete($id, $this->modelMaster, $this->modulName);
    }
}
