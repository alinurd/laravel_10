<div class="card shadow-lg">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 text-primary"><i class="fas fa-user-circle me-2"></i>Normalisasi/Perhitungan</h5>
    </div>
    <div class="card-body">
        <table class="table table-hover table-bordered table-sm ">
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
                            @php
                                $n = $normalisasi[$c['id']][$k['id']];
                            @endphp
                            <td class="text-center">
                                Rumus: <br>
                                <i>{{ $n['rumus'] }}</i><br>
                                <strong>{{ $n['val'] }}</strong>
                            </td>
                        @endforeach

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
