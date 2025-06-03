<div class="card shadow-lg">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 text-primary"><i class="fas fa-user-circle me-2"></i>Daftar Bobot Kriteria</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover mb-4 mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>Ranking</th>
                    <th>Nama Alternatif</th>
                    <th>Skor Akhir</th>
                                <th>Rumus Perhitungan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ranking as $i => $r)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $r['nama'] }}</td>
                        <td>{{ $r['skor'] }}</td>
                                        <td>{!! $r['rumus'] !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
            @include('pages.dashboard.saw.landing._rangking')

    </div>
</div>
