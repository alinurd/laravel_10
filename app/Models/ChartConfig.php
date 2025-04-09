<?php
// app/Models/ChartConfig.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GlobalDataTrait;

class ChartConfig extends Model
{
    use HasFactory,GlobalDataTrait;
    protected $table = 'chart_configs';  
    protected $keyType = 'int'; 

    
    protected $fillable = [
        'jenis',
        'parent',
        'judul',
        'module',
        'label',
        'kelompok',
        'data_id',  
        'operasi',
        'datasets'
    ];

    protected $casts = [
        'datasets' => 'array'
    ];


    public static function generateChrat()
    {
        return [
            'chartGenerate' => [
                'transaksi' => [
                    'kelompok' => [
                        'bulan' => self::getDataBulan(),
                        'tahun' => self::getDataTahun(2020, 2025),
                        'jenis' => [
                            ['id' => 1, 'val' => 'Pengeluaran'],
                            ['id' => 2, 'val' => 'Pemasukan']
                        ],
                        'kategori' => [
                            ['id' => 1, 'val' => 'pembayaran karyawan'],
                            ['id' => 2, 'val' => 'tambah 1-edit menjadi aktif']
                        ]
                    ],
                    'data' => [
                        ['id' => 'nominal', 'val' => 'nominal', 'opration' => ['SUM', 'MAX', 'MIN', 'AVERAGE', 'COUNT']],
                        ['id' => 'jumlah_ransaksi', 'val' => 'Jumlah Transaksi', 'opration' => ['COUNT']]
                    ]
                ],
                'piutang' => [
                    'kelompok' => [
                        // 'bulan' => self::getDataBulan(3),
                        // 'tahun' => self::getDataTahun(2024, 2025),
                        'jenis' => [
                            ['id' => 1, 'val' => 'Hutang'],
                            ['id' => 2, 'val' => 'Piutang']
                        ],
                        'kategori' => [
                            ['id' => 1, 'val' => 'pembayaran karyawan'],
                            ['id' => 2, 'val' => 'tambah 1-edit menjadi aktif']
                        ]
                    ],
                    'data' => [
                        ['id' => 'nominal', 'val' => 'nominal', 'opration' => ['SUM', 'MAX', 'MIN', 'AVERAGE', 'COUNT']],
                        ['id' => 'jumlah_ransaksi', 'val' => 'Jumlah Transaksi', 'opration' => ['COUNT']]
                    ]
                ]
            ]
        ];
    }
    
}