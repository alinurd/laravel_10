<?php

namespace App\Http\Controllers;

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
        $this->modelMaster = "App\Models\Combo";
        $option = [
            ['id' => 1, 'value' => 'contoh key 1'],
            ['id' => 2, 'value' => 'ssssssssss1'],
        ];
        
        $this->list = [
            ['field' => 'pid', 'type' => 'text', 'filter' => false, 'position' => false, 'show' => true, 'required' => true],
            ['field' => 'categori', 'type' => 'text', 'filter' => true, 'position' => false, 'show' => true, 'required' => true],
            ['field' => 'data', 'type' => 'text', 'filter' => true, 'position' => 'center', 'show' => true, 'required' => true],
            ['field' => 'key1', 'type' => 'number', 'filter' => true, 'position' => 'center', 'show' => false, 'required' => false],
            [
                'field' => 'key2', 'type' => 'select', 'filter' => true, 'position' => 'center', 'show' => false, 'required' => false,
                'option' => $option,
            ],
        ];

        
        $this->setFrom=$this->_SETDATALIST(['list' => $this->list], $this->modulName);
        
        $this->_SETCORE= $this->_SETCORE($this->modulName);
        
    }
    
    public function index()
    { 
        $data=$this->_SETCORE;
        $data['list'] = array_merge($this->setFrom);  
        $data['field'] = $this->getCombo();
        $data['sessionOK'] = session('success');
        // $data['ses'] = ['success'=>session('success'),'failed'=>session('failed')];
         return view('pages.index', $data);

    }
    public function create()
    {
        $data=$this->_SETCORE;
        $data['list'] = array_merge($this->setFrom);  
        $data['field'] = $this->getCombo();
        $data['mode'] ='add';
        return view('pages.index', $data);
    }

    public function store(Request $request, CRUDService $CRUDService)
    {
        $result = $CRUDService->create($request, $this->modelMaster, $this->setFrom);
    
        if ($result) {
            session()->flash('success', 'Menu item has been created successfully!');
            return redirect()->route($this->modulName . '.index');
        } else {
            session()->flash('failed', 'Menu item was not created successfully!');
            return back();
        }
    }
    

    public function storess(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
