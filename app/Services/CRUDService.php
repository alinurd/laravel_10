<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\MenuGroup;
use App\Models\Combo;

class CRUDService
{
  public function create(Request $request, $tblMaster, $dataForm, $mdl)
  {
       $data = [];
  
       foreach ($dataForm as $fieldData) {
           if (isset($fieldData['field'])) {
              $data[$fieldData['field']] = $request->input($fieldData['field'], null);
          }
      }
      $tblMaster::create($data);

        return redirect()->route($mdl . '.index')->with('success', 'Data Created successfully!');

  }
  

  public function update($id, Request $request, $tblMaster, $dataForm, $mdl)
  {
       $record = $tblMaster::find($id);
       if (!$record) {
          return back()->with('failed', 'Data not found');
      }
      $data = [];
       foreach ($dataForm as $fieldData) {
          if (isset($fieldData['field'])) {
              $data[$fieldData['field']] = $request->input($fieldData['field'], null);
          }
      }
      $record->update($data);
      return redirect()->route($mdl . '.index')->with('success', 'Data updated successfully!');
  }
  
}
