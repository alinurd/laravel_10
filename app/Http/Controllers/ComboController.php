<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
class ComboController extends _Controller
{
    protected $modulName = '';
    protected $_SETCORE = '';
    protected $list = '';
    protected $setFrom = '';
    public function __construct()
    {
        $this->modulName = "combo";

        $option = [
            ['id' => 'contoh key 1'],
            ['id' => 'contoh key ssssssssss'],
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
        return view('pages.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data=$this->_SETCORE;
        $data['list'] = array_merge($this->setFrom);  
        $data['field'] = $this->getCombo();
        $data['mode'] ='add';
        return view('pages.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
