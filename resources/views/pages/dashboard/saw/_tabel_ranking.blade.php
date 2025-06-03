<table class="table table-bordered table-hover mb-4 mt-4">
    <thead class="thead-dark">
        <tr>
            <th>Ranking</th>
            <th>Nama Alternatif</th>
            <th>Skor Akhir</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ranking as $i => $r)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $r['nama'] }}</td>
                <td>{{ $r['skor'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
