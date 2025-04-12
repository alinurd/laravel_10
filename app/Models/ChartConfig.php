<?php
// app/Models/ChartConfig.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GlobalDataTrait;
use App\Traits\ChartTrait; 
use Illuminate\Support\Facades\DB;

class ChartConfig extends Model
{
    use HasFactory, GlobalDataTrait, ChartTrait;
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
                        ['id' => 'nominal', 'val' => 'nominal', 'opration' => ['AVERAGE', 'COUNT']],
                        ['id' => 'jumlah_ransaksi', 'val' => 'Jumlah Transaksi', 'opration' => ['COUNT', 'COUNT', 'COUNT']]
                    ]
                ]
            ]
        ];
    }



    public function getparent()
    {
        return $this->belongsTo(Chart::class, 'parent'); // atau Chart::class jika relasi ke model lain
    }

    public static function getDefaultCharts($w = [], $val = [])
    {
        DB::statement("SET lc_time_names = 'en_US'");

        $where = [
            ["w" => "module", "v" => "transaksi"]
        ];

        $query = ChartConfig::with('getparent');
        foreach ($where as $q) {
            $query->where($q['w'], $q['v']);
        }

        $chartConfigs = $query->get();

        if ($chartConfigs->isEmpty()) {
            abort(404, "Chart config tidak ditemukan");
        }

       $chartData=self::getTraitChartArr($chartConfigs);

        return $chartData;
    }






    public static function getChartDataForPolarArea($data = [])
    {
        return self::where($data['module'] . $data['kelompok'], 45)
            ->join('stakeholders', 'piutang.stackholder', '=', 'stakeholders.id')
            ->select(
                DB::raw('stakeholders.name as stakeholder_name'),
                DB::raw('stakeholders.pic as stakeholder_pic'),
                DB::raw('SUM(nominal) as total_nominal')
            )
            ->groupBy('piutang.stackholder', 'stakeholders.name', 'stakeholders.pic')
            ->get()
            ->map(function ($item) {
                return [
                    'stackholder' => $item->stakeholder_name ?? $item->stakeholder_pic ?? 'Unknown',
                    'total_nominal' => (int) $item->total_nominal,
                ];
            });
    }
}
