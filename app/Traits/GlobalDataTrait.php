<?php

namespace App\Traits;

trait GlobalDataTrait
{
    
    public static function getDataBulan($id = false)
    {
        $data = [
            ['id' => 1, 'val' => 'Januari'],
            ['id' => 2, 'val' => 'Februari'],
            ['id' => 3, 'val' => 'Maret'],
            ['id' => 4, 'val' => 'April'],
            ['id' => 5, 'val' => 'Mei'],
            ['id' => 6, 'val' => 'Juni'],
            ['id' => 7, 'val' => 'Juli'],
            ['id' => 8, 'val' => 'Agustus'],
            ['id' => 9, 'val' => 'September'],
            ['id' => 10, 'val' => 'Oktober'],
            ['id' => 11, 'val' => 'November'],
            ['id' => 12, 'val' => 'Desember'],
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
