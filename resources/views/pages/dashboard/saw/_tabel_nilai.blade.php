<table class="table table-hover table-bordered table-sm mt-4">
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
                        {{ collect($jawaban)->firstWhere(fn($j) => $j['chanel_id'] == $c['id'] && $j['kriteria_id'] == $k['id'])['nilai'] ?? '-' }}
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
    <tfoot class="table-light">
        <tr>
            <th>Pembagi</th>
            @foreach ($kriteria['data'] as $k)
                <th class="text-center">{{ $pembagiKriteria[$k['id']] ?? '-' }}</th>
            @endforeach
        </tr>
    </tfoot>
</table>
