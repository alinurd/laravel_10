<div class="card shadow-lg mb-4" id="evaluationForm" style="display:none;">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-primary">📝 Penilaian Alternatif Berdasarkan Kriteria</h5>
        <span class="badge bg-info">
            <i class="fas fa-user me-1"></i>
            <span id="userNameBadge"></span>
        </span>
    </div>
    <div class="card-body">
        <form action="{{ route('saw.proses') }}" method="POST" id="sawForm">
            @csrf
            <input type="hidden" name="user_name" id="formUserName">
            <input type="hidden" name="user_institution" id="formUserInstitution">

            @foreach ($kriteria as $index => $k)
                <div class="mb-4 pb-3 border-bottom">
                    <div class="d-flex align-items-center mb-3">
                        <div class="badge bg-primary rounded-circle me-3" style="width: 30px; height: 30px; line-height: 30px;">
                            {{ $loop->iteration }}
                        </div>
                        <h6 class="fw-bold mb-0 text-dark">{{ $k['nama'] }}</h6>
                        <span class="badge bg-{{ $k['atribut'] == 2 ? 'success' : 'danger' }} ms-auto">
                            {{ $k['atribut'] == 2 ? 'Benefit' : 'Cost' }}
                        </span>
                        <button type="button" class="btn btn-sm btn-link ms-2" data-bs-toggle="tooltip" title="{{ $k['deskripsi'] ?? 'Tidak ada deskripsi' }}">
                            <i class="fas fa-info-circle"></i>
                        </button>
                    </div>

                    <div class="row g-3">
                        @foreach ($alternatif as $a)
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label fw-semibold text-muted">{{ $a['nama'] }}</label>
                                    <select name="nilai[{{ $a['id'] }}][{{ $k['id'] }}]" class="form-select border-2" required>
                                        <option value="">-- Pilih Nilai --</option>
                                        @if ($k['get_sub_kriteria'])
                                                                @foreach ($k['get_sub_kriteria'] as $s)
                                                                 <option value="{{$s['nilai']}}">{{$s['ket']}} ({{$s['nilai']}})</option>
                                                                @endforeach
                                        
                                        @endif
                                    </select>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                <button type="reset" class="btn btn-outline-secondary me-md-2">
                    <i class="fas fa-undo me-1"></i> Reset
                </button>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-calculator me-1"></i> Proses & Lihat Hasil
                </button>
            </div>
        </form>
    </div>
</div>
