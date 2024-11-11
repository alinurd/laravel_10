<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\MenuGroup;
use App\Models\Combo;

class CRUDService
{
  public function create(Request $request, $tblMaster, $dataForm)
  {
       $data = [];
  
       foreach ($dataForm as $fieldData) {
           if (isset($fieldData['field'])) {
              $data[$fieldData['field']] = $request->input($fieldData['field'], null);
          }
      }
  
       return $tblMaster::create($data);
  }
  

  public function update(Request $request, MenuGroup $menuGroup, MenuItem $menuItem): MenuItem|bool
  {
    return $menuItem->update(array_merge(
      $request->validated(),
      array(
        'menu_group_id' => $menuGroup->id,
        'status' => !blank($request->status) ? true : false
      )
    ));
  }
}
