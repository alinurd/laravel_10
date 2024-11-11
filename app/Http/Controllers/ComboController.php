<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
class ComboController extends _Controller
{
    protected $modulName = '';
    protected $_SETCORE = '';
    public function __construct()
    {
        $this->modulName = "combo";
        $this->_SETCORE= $this->_SETCORE();
    }
    public function index()
    {

        $list = [
            ['field' => 'pid','filter'=>false,'position'=>false, 'show'=>true],
            ['field' => 'categori','filter'=>true,'position'=>false, 'show'=>true],
            ['field' => 'data','filter'=>true,'position'=>'center', 'show'=>true]
        ];

        $data=$this->_SETCORE(['pid', 'categori', 'data']);
        $data['list'] = array_merge($this->_SETDATALIST(['list' => $list]));  
        $data['field'] = $this->getCombo();
         return view('pages.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
