<?php

namespace App\Traits;

trait GlobalDataTrait
{
    
    public static function getDataBulan($id = false)
    {
        $data = [
            ['id' => 1, 'val' => 'January'],
            ['id' => 2, 'val' => 'February'],
            ['id' => 3, 'val' => 'March'],
            ['id' => 4, 'val' => 'April'],
            ['id' => 5, 'val' => 'May'],
            ['id' => 6, 'val' => 'June'],
            ['id' => 7, 'val' => 'July'],
            ['id' => 8, 'val' => 'August'],
            ['id' => 9, 'val' => 'September'],
            ['id' => 10, 'val' => 'October'],
            ['id' => 11, 'val' => 'November'],
            ['id' => 12, 'val' => 'December'],
        ];
    
        if ($id != false) {
            foreach ($data as $item) {
                if ($item['id'] == $id) {
                    return [['id' => $item['id'], 'val' => $item['val']]];
                }
            }
            return null; // kalau id tidak ditemukan
        }
        
    
        return $data;
    }
    
    
    public static function getDataTahun($start = 2020, $end = null)
    {
        $end = $end ?? date('Y');
        $data = [];
        foreach (range($start, $end) as $year) {
            $data[] = ['id' => $year, 'val' => (string) $year];
        }
        return $data;
    }
    
}
