<table class="table table-hover table-bordered table-sm mt-4">
    <thead class="table-light">
        <tr>
            <th>Alternatif</th>
            @foreach ($kriteria['data'] as $k)
                <th class="text-center">{{ $k['nama'] }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($chanel as $c)
            <tr>
                <td>{{ $c['nama'] }}</td>
                @foreach ($kriteria['data'] as $k)
                    <td class="text-center">
                        {{ number_format($normalisasi[$c['id']][$k['id']] ?? 0, 4) }}
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
