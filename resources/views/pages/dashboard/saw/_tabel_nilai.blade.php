<div class="card shadow-lg">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 text-primary"><i class="fas fa-user-circle me-2"></i>Daftar Bobot Kriteria</h5>
    </div>
    <div class="card-body">
        <table class="table table-hover table-bordered table-sm">
            <thead class="table-light">
                <tr>
                    <th>Alternatif</th>
                    @foreach ($kriteria['data'] as $k)
                        <th class="text-center">{{ $k['nama'] }}<br>
                            <i>({{ $k['atribut'] == 1 ? 'Cost' : 'Benefit' }})</i>
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($chanel as $c)
                    <tr>
                        <td>{{ $c['nama'] }}</td>
                        @foreach ($kriteria['data'] as $k)
                            <td class="text-center">
                                {{ collect($jawaban)->firstWhere(fn($j) => $j['chanel_id'] == $c['id'] && $j['kriteria_id'] == $k['id'])['nilai'] ?? 0 }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
            <tfoot class="table-light">
                <tr>
                    <th>Pembagi</th>
                    @foreach ($kriteria['data'] as $k)
                        <th class="text-center">{{ $pembagiKriteria[$k['id']] ?? 0 }}</th>
                    @endforeach
                </tr>
            </tfoot>
        </table>
    </div>
</div>
