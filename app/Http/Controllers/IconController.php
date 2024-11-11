<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Services\CRUDService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
class IconController extends _Controller
{
    protected $modulName = '';
    protected $_SETCORE = '';
    protected $list = '';
    protected $setFrom = '';
    protected $modelMaster = '';
    public function __construct()
    {
        $this->modulName = "icon";
        $this->modelMaster = "App\Models\Icon";
        $option = [
            ['id' => 1, 'value' => 'Active'],
            ['id' => 2, 'value' => 'Non Acive'],
        ];
        
        $this->list = [
            ['field' => 'id', 'type' => 'text', 'filter' => false, 'position' => false, 'show' => false, 'required' => true],
            ['field' => 'nama', 'type' => 'text', 'filter' => false, 'position' => false, 'show' => true, 'required' => true],
            ['field' => 'data', 'type' => 'text', 'filter' => true, 'position' => false, 'show' => true, 'required' => true],
             [
                'field' => 'status', 'type' => 'select', 'filter' => true, 'position' => 'center', 'show' => true, 'required' => false,  'where' => null,
                'option' => $option,
                'multiple' => false,
            ],
        ];

        
        $this->setFrom=$this->_SETDATALIST(['list' => $this->list], $this->modulName);
        
        $this->_SETCORE= $this->_SETCORE($this->modulName);
        
    }
    
    public function index()
    { 
        $data=$this->_SETCORE;
        $data['list'] = array_merge($this->setFrom);  
        $data['field'] = $this->getCombo($this->modelMaster, $this->list);
        $data['sessionOK'] = session('success');
        // $data['ses'] = ['success'=>session('success'),'failed'=>session('failed')];
         return view('pages.index', $data);
    }

    public function create()
    {
        $data=$this->_SETCORE;
        $data['list'] = array_merge($this->setFrom);  
        $data['field'] = $this->getCombo($this->modelMaster, $this->list);
        $data['mode'] ='add';
        return view('pages.index', $data);
    }

    public function store(Request $request, CRUDService $CRUDService)
    {
        $result = $CRUDService->create($request, $this->modelMaster, $this->setFrom, $this->modulName);
    
        if ($result) {
            session()->flash('success', 'Menu item has been created successfully!');
            return redirect()->route($this->modulName . '.index');
        } else {
            session()->flash('failed', 'Menu item was not created successfully!');
            return back();
        }
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
        $data=$this->_SETCORE;
        $data['list'] = array_merge($this->setFrom);  
        $data['id'] =$id;
        $data['field'] =$this->modelMaster::find($id);
         $data['mode'] ='edit';
        return view('pages.index', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, CRUDService $CRUDService)
    {
         return $CRUDService->update($id,$request, $this->modelMaster, $this->setFrom, $this->modulName);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id , CRUDService $CRUDService)
    {
        return $CRUDService->delete($id, $this->modelMaster,$this->modulName);

    }
}
