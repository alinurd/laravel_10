<?php

namespace App\Http\Controllers;

use App\Http\Requests\CRUDRequest;
use App\Models\Combo;
use App\Models\DocFerifyDetail;
use App\Models\DocFerifyHeader;
use App\Models\MenuItem;
use App\Models\PIC;
use App\Services\CRUDService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Isset_;

class DocumenctferifyReviewController extends _Controller
{
    protected $modulName = '';
    protected $_SETCORE = '';
    protected $list = '';
    protected $setFrom = '';
    protected $modelMaster = '';
    public function __construct()
    {
        $this->modulName = "documenctferifyreview";
        $this->modelMaster = "App\Models\DocFerifyHeader";
        $sts = $this->_cbo(Combo::class, ['id', 'data'], true, ['where' => [['f' => 'pid', 'v' => 'sts'], ['f' => 'categori', 'v' => 'sts']] ]);
                
        $cbo_pic = $this->_cbo(PIC::class, ['id', 'nama'], true);

        $this->list = [ [
            'field' => 'kode',
            'type' => 'text',
            'filter' => true,
            'position' => 'center',
            'showList' => true,
            'show' => false,
            'required' => false,
            'where' => null,
            'option' => $cbo_pic,
            'multiple' => false,
            ],
            [
                'field' => 'pic',
                'type' => 'select',
                'filter' => true,
                'position' => 'center',
                'show' => true,
                'required' => false,
                'where' => null,
                'option' => $cbo_pic,
                'multiple' => false,
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
                'input' => 'rupiah',
                'filter' => false,
                'position' => 'right',
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
        $data['costum'] = $this->getCombo("App\Models\Combo", ['where' => ['field' => 'categori', 'where' => 'docferify']]);
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
        $header = $this->modelMaster::find($id);
        $details = $header->getDetails;
        $data['field'] = $header;
        $data['dataDetail'] = $details;
        $data['mode'] = 'show';
        $costum=$this->getCombo("App\Models\Combo", ['where' => ['field' => 'categori', 'where' => 'docferify']]);
        // $costum['view']='documenctferifyreview';
        $data['costum'] =$costum ;
        $data['costum']['header'] = $this->modelMaster::find($id);

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
        $header = $this->modelMaster::find($id);
        $details = $header->getDetails;
        $data['field'] = $header;
        $data['dataDetail'] = $details;
        $data['mode'] = 'edit';
        $data['costum'] = $this->getCombo("App\Models\Combo", ['where' => ['field' => 'categori', 'where' => 'docferify']]);

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
            $headerData = $request->only(['pic', 'jenis_product', 'nilai', 'status']);
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


    public function update(CRUDRequest $request, string $id)
    {
        DB::beginTransaction();

        try { 
            $header = DocFerifyHeader::findOrFail($id);
            $headerData = $request->only(['pic', 'jenis_product', 'nilai', 'status']);
             $header->update($headerData);

            $customData = $request->input('customEdit');


            $cName = $customData['cName'];

            if ($customData) {
                foreach ($cName as $key) {
                    if (isset($customData[$key])) {
                        $fields = $customData[$key];

                        if (isset($fields['Uraian'])) {
                            foreach ($fields['Uraian'] as $k => $p) { 
                                if (isset($fields['id'][$k])) {
                                    DocFerifyDetail::where('id', $fields['id'][$k])->update([
                                        'id_doc_ferify' => intval($id),
                                        'pid' => $key,
                                        'uraian' => $p ?? null,
                                        'dos' => !empty($fields['DOS'][$k]) ? date('Y-m-d', strtotime($fields['DOS'][$k])) : null,
                                        'ket' => $fields['Ket'][$k] ?? null,
                                        'dov' => !empty($fields['DOV'][$k]) ? date('Y-m-d', strtotime($fields['DOV'][$k])) : null,
                                        'status' => true,
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
            $inputIds = collect($customData)
            ->flatMap(function ($item) {
                return $item['id'] ?? [];
            })
            ->filter()
            ->toArray();
         
        DocFerifyDetail::whereNotIn('id', $inputIds)
            ->where('id_doc_ferify', intval($id))
            ->delete();  

            $customDataBaru = $request->input('custom');
            $cName = $customData['cName'];
            if ($customDataBaru) {
                foreach ($cName as $key) {
                    if (isset($customDataBaru[$key])) {
                        $fields = $customDataBaru[$key];
                        foreach ($fields['Uraian'] as $k => $p)
                            DocFerifyDetail::create([
                                'id_doc_ferify' => intval($id),
                                'pid' => $key,
                                'uraian' => $p ?? null,
                                'dos' => !empty($fields['DOS'][$k]) ? date('Y-m-d', strtotime($fields['DOS'][$k])) : null,
                                'ket' => $fields['Ket'][$k] ?? null,
                                'dov' => !empty($fields['DOV'][$k]) ? date('Y-m-d', strtotime($fields['DOV'][$k])) : null,
                                'status' => true,
                            ]); 
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
    public function updateDov(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'id' => 'required|integer',
            // 'dov' => 'required|date',
            'ket_review' => 'nullable|string',
            'review' => 'nullable|string',
        ]);

        $ket_review=$request->ket_review;
        $dov=$request->dov;
        $review=$request->review;
        $reset=$request->reset;
        if(!$dov){
            $dov=date('Y-m-d');
        }

        if($reset==2){
            $ket_review=null;
            $dov=null;
            $review=0;
        }
        
        $detail = DocFerifyDetail::find($request->id);
        if ($detail) {
            $detail->ket_review = $ket_review;
            $detail->dov = $dov;
             $detail->review = $review;
            $detail->save(); 
            return response()->json(['success' => true, 'data' => $detail, 'review' =>intval($review)]);
        }
    
        // Jika data tidak ditemukan
        // return response()->json(['success' => true, 'message' => 'OK'], 200);
    }

    /**
     * Undefined function
     * 
     * @return Type Returns data of type Type
     */
    public function termin()
    {
        $data=[];
        return view('pages.document.monitoring', $data);

    }
    
}
