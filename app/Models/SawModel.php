<?php

namespace App\Models;

class SawModel
{
    /**
     * Hitung hasil perankingan SAW
     * @param array $alternatif => list alternatif
     * @param array $kriteria => list kriteria dengan bobot dan atribut
     * @param array $jawaban => list nilai jawaban (alternatif_id, kriteria_id, nilai)
     * @return array
     */
    public static function hitungRanking(array $alternatif, array $kriteria, array $jawaban, string $user = null): array
    {

        $pembagiKriteria = [];
        foreach ($kriteria as $k) {
            $nilai = collect($jawaban)->where('kriteria_id', $k['id'])->pluck('nilai')->filter()->all();
            $pembagiKriteria[$k['id']] = !empty($nilai)
                ? ($k['atribut'] == 1 ? 1 : 3)
                // ? ($k['atribut'] == 1 ? min($nilai) : max($nilai))
                : 1;
        }

        $hasil = [];
        foreach ($alternatif as $alt) {
            $skor = 0;
            foreach ($kriteria as $k) {
                $nilai = collect($jawaban)->first(fn($j) => $j['chanel_id'] == $alt['id'] && $j['kriteria_id'] == $k['id'])['nilai'] ?? 0;
                // $normalisasi = $k['atribut'] == 1
                //     ? ($pembagiKriteria[$k['id']] != 0 ? $pembagiKriteria[$k['id']] / $nilai : 0)
                //     : ($pembagiKriteria[$k['id']] != 0 ? $nilai / $pembagiKriteria[$k['id']] : 0);
                $normalisasi = 0;

                if ($k['atribut'] == 1) { // cost
                    if ($nilai != 0) {
                        $normalisasi = $pembagiKriteria[$k['id']] / $nilai;
                    }
                } else { // benefit
                    if ($pembagiKriteria[$k['id']] != 0) {
                        $normalisasi = $nilai / $pembagiKriteria[$k['id']];
                    }
                }


                $skor += $normalisasi * $k['bobot_normalisasi'];
            }
            $hasil[] = [
                'nama' => $alt['nama'],
                'skor' => round($skor, 4)
            ];
        }


        return collect($hasil)->sortByDesc('skor')->values()->all();
    }
}
