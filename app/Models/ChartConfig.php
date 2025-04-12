<?php
// app/Models/ChartConfig.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GlobalDataTrait;
use Illuminate\Support\Facades\DB;

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
                        ['id' => 'nominal', 'val' => 'nominal', 'opration' => [ 'AVERAGE', 'COUNT']],
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

    $chartData = [];

    foreach ($chartConfigs as $chartConfig) {
        $operasi = strtolower($chartConfig->operasi);
        $kelompok = $chartConfig->kelompok;
        $dataId = $chartConfig->data_id;

        // Ambil konfigurasi warna & label dari kolom datasets (json)
        $datasetConfig = is_string($chartConfig->datasets)
            ? json_decode($chartConfig->datasets, true)
            : $chartConfig->datasets;

        $labelData = collect($datasetConfig)->pluck('label')->toArray();
        $backgroundColors = collect($datasetConfig)->pluck('backgroundColor')->toArray();

        // Tentukan label dan groupBy berdasarkan kelompok
        switch ($kelompok) {
            case 'bulan':
                $labelFormat = 'DATE_FORMAT(tgl, "%M")';
                $orderFormat = 'MONTH(tgl_urutan)';
                break;
            case 'tahun':
                $labelFormat = 'YEAR(tgl)';
                $orderFormat = 'YEAR(tgl_urutan)';
                break;
            default:
                $labelFormat = $kelompok;
                $orderFormat = $kelompok;
        }

        // Query data transaksi
        $rawData = DB::table('transaksi')
            ->select([
                DB::raw("$labelFormat as label"),
                DB::raw(strtoupper($operasi) . "($dataId) as value"),
                DB::raw("MIN(tgl) as tgl_urutan")
            ])
            ->groupBy(DB::raw($labelFormat))
            ->orderBy(DB::raw($orderFormat))
            ->get()
            ->keyBy('label'); // untuk matching dengan label dari config

        // Siapkan nilai chart berdasarkan urutan label dari config
        $values = [];
        foreach ($labelData as $label) {
            $values[] = isset($rawData[$label]) ? $rawData[$label]->value : 0;
        }

        // Susun chart berdasarkan jenis
        $chart = [
            'type' => $chartConfig->jenis,
            'data' => [
                'labels' => $labelData,
                'datasets' => [[
                    'label' => $chartConfig->label ?? 'Dataset',
                    'data' => $values,  // Ensure values are properly passed for doughnut, pie, and polarArea
                    'backgroundColor' => $backgroundColors,  // Ensure background colors are passed correctly
                    'borderColor' => '#000',
                    'borderWidth' => 1,
                ]]
            ],
            'options' => [
                'responsive' => true,
                'plugins' => [
                    'legend' => ['position' => 'top'],
                    'title' => [
                        'display' => true,
                        'text' => $chartConfig->judul ?? 'Judul Grafik',
                    ],
                ],
                'scales' => $chartConfig->jenis == 'bar' || $chartConfig->jenis == 'line' ? [
                    'y' => [
                        'beginAtZero' => true,
                    ],
                ] : null, // Mengaktifkan sumbu Y untuk chart bar dan line

                'elements' => [
                    // Jika jenis chart 'doughnut', 'pie', atau 'polarArea', kita bisa menyesuaikan radius dan spacing
                    'arc' => in_array($chartConfig->jenis, ['doughnut', 'pie', 'polarArea']) ? [
                        'borderWidth' => 1,
                        'spacing' => 0,
                    ] : [],
                ],

                // Menambahkan pengaturan khusus untuk chart polarArea
                'rotation' => $chartConfig->jenis == 'polarArea' ? -0.5 * M_PI : 0, // Using M_PI constant for PI in PHP
            ]
        ];

        // Simpan berdasarkan parent
        $key = $chartConfig->getparent
            ? $chartConfig->getparent->name . ' - ' . $chartConfig->getparent->jenis
            : 'Tanpa Parent';

        $chartData[$key][] = $chart;
    }

    return $chartData;
}


public static function getDefaultCharts_($w = [], $val = [])
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

    $chartData = [];

    foreach ($chartConfigs as $chartConfig) {
        $operasi = strtolower($chartConfig->operasi);
        $kelompok = $chartConfig->kelompok;
        $dataId = $chartConfig->data_id;

        // Ambil konfigurasi warna & label dari kolom datasets (json)
        $datasetConfig = is_string($chartConfig->datasets)
            ? json_decode($chartConfig->datasets, true)
            : $chartConfig->datasets;

        $labelData = collect($datasetConfig)->pluck('label')->toArray();
        $backgroundColors = collect($datasetConfig)->pluck('backgroundColor')->toArray();

        // Tentukan label dan groupBy berdasarkan kelompok
        switch ($kelompok) {
            case 'bulan':
                $labelFormat = 'DATE_FORMAT(tgl, "%M")';
                $orderFormat = 'MONTH(tgl_urutan)';
                break;
            case 'tahun':
                $labelFormat = 'YEAR(tgl)';
                $orderFormat = 'YEAR(tgl_urutan)';
                break;
            default:
                $labelFormat = $kelompok;
                $orderFormat = $kelompok;
        }

        // Query data transaksi
        $rawData = DB::table('transaksi')
            ->select([
                DB::raw("$labelFormat as label"),
                DB::raw(strtoupper($operasi) . "($dataId) as value"),
                DB::raw("MIN(tgl) as tgl_urutan")
            ])
            ->groupBy(DB::raw($labelFormat))
            ->orderBy(DB::raw($orderFormat))
            ->get()
            ->keyBy('label'); // untuk matching dengan label dari config
        // Siapkan nilai chart berdasarkan urutan label dari config
        $values = [];
        foreach ($labelData as $label) {
            $values[$label] = isset($rawData[$label]) ? $rawData[$label]->value : 0;
        }
        $chart = [
            'type' => $chartConfig->jenis,
            'data' => [
                'labels' => $labelData,
                'datasets' => [[
                    'label' => $chartConfig->label ?? 'Dataset',
                    'data' => $values,
                    'backgroundColor' => $backgroundColors,
                    'borderColor' => '#000',
                    'borderWidth' => 1,
                ]]
            ],
            'options' => [
                'responsive' => true,
                'plugins' => [
                    'legend' => ['position' => 'top'],
                    'title' => [
                        'display' => true,
                        'text' => $chartConfig->judul ?? 'Judul Grafik',
                    ],
                ],
                // Tambahkan pengaturan berbeda berdasarkan tipe chart
                'scales' => $chartConfig->jenis == 'bar' || $chartConfig->jenis == 'line' ? [
                    'y' => [
                        'beginAtZero' => true,
                    ],
                ] : null, // Mengaktifkan sumbu Y untuk chart bar dan line
                'elements' => [
                    // Jika jenis chart 'doughnut', 'pie', atau 'polarArea', kita bisa menyesuaikan radius dan spacing
                    'arc' => $chartConfig->jenis == 'doughnut' || $chartConfig->jenis == 'pie' || $chartConfig->jenis == 'polarArea' ? [
                        'borderWidth' => 1,
                        'spacing' => 0,
                    ] : [],
                ],
                // Menambahkan pengaturan khusus untuk chart polarArea
                'rotation' => $chartConfig->jenis == 'polarArea' ? -0.5 * M_PI : 0, // Using M_PI constant for PI in PHP
            ]
        ];
        

        // Simpan berdasarkan parent
        $key = $chartConfig->getparent
            ? $chartConfig->getparent->name . ' - ' . $chartConfig->getparent->jenis
            : 'Tanpa Parent';

        $chartData[$key][] = $chart;
    }

    return $chartData;
}





    public static function getChartDataForPolarArea($data=[])
{
    return self::where($data['module'].$data['kelompok'], 45)
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