@extends('components.layouts.app')

@section('title', 'Monitoring Termin')

@section('breadcrumb')
<x-dashboard.breadcrumb title="Monitoring Termin" page="{{$header['kode']}}" active="Termin {{$terminid}}" route="#" />
@endsection

@section('content')

@php
$detail=$header['getDetails'];
if(isset($header['termin'])){
$arrTermin=json_decode($header['termin']);
}
$couTermin=count($arrTermin);
$ttlNominalTermin = collect($arrTermin)->sum(fn($item) => (int) $item->nominal);


@endphp
<div class="card">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex flex-column align-items-start">
                    <h5 class="card-title">Activity {{$couTermin}} Termin</h5>
                    <div class="progress animated-progress custom-progress progress-label w-100 mt-2" style="z-index: 999;">
                        <div class="progress-bar text-white" role="progressbar"
                            style="width: 10%; background: linear-gradient(to right, red, green);"
                            aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                            <div class="label">30%</div>
                        </div>
                    </div>


                    <div class="ms-auto mt-2">
                        <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">

                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#history" role="tab">History</a>
                            </li>
                            @if($arrTermin)
                            @foreach($arrTermin as $i => $termin)
                            <li class="nav-item">
                                <a class="nav-link "
                                    data-bs-toggle="tab"
                                    data-sts="{{ $header['status'] }}"
                                    data-kode="{{ $header['kode'] }}"
                                    data-termin="{{ $termin->termin }}"
                                    data-nominal="{{ $termin->nominal }}"
                                    href="#termin{{ $termin->termin }}"
                                    role="tab">
                                    Termin {{ $termin->termin }}
                                </a>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="tab-content text-muted">
                <div class="accordion accordion-flush" id="todayExample">
                    <div class="accordion-item border-0">
                        <div class="accordion-header" id="headingOne">
                            <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">

                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-14 fw-bold mb-1 ">
                                            {{$header['kode']}}
                                        </h6>
                                        <small class="text-muted">dibuat Oleh: {{$header['created_by']}} pada {{$header['created_at']}}</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body ms-2 ps-5">
                                Jumlah dokument: {{count($detail)}}, memiliki nilai product sebedar Rp. {{$header['nilai']}}, memiliki {{$couTermin}} termin dengan jumlah nominal keserulhan sebesar Rp. {{ number_format($ttlNominalTermin, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>


                <!-- history -->

                <div class="tab-pane active" id="history" role="tabpanel">
                    <div class="profile-timeline">
                        <div class="text-muted" style="padding-left: 20px;padding-top: 15px;"><u>History pembayaran Termin</u></div>
                        <div class="accordion accordion-flush" id="historyExample">
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="heading8">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapse812" aria-expanded="true">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-light text-success rounded-circle">
                                                    <i class="ri-bookmark-3-fill"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-1">
                                                    TERMIN 1 | @admin
                                                </h6>
                                                <small class="text-muted">4 hari yang lalu - 14 mei 2025 10:58:19</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapse812" class="accordion-collapse collapse" aria-labelledby="heading8" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 fst-italic">
                                        Lorem ipsum, atau ringkasnya lipsum, adalah teks standar yang ditempatkan untuk mendemostrasikan elemen grafis atau presentasi visual seperti font, tipografi, dan tata letak
                                        <div class="row mt-2">
                                            <div class="col-xxl-6">
                                                <div class="row border border-dashed gx-2 p-2">
                                                    <div class="col-3">
                                                        <img src="/assets/images/small/img-3.jpg" alt="" class="img-fluid rounded" />
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end accordion-->
                    </div>
                </div>

                @foreach($arrTermin as $i => $termin)
                <div class="tab-pane fade {{ $i == 0 ? 'show  ' : '' }}" id="termin{{ $termin->termin }}" role="tabpanel">

                    <div class="profile-timeline">
                        <div class="accordion accordion-flush" id="monthlyExample">
                            <div id="collapse{{ $termin->termin }}" class="accordion-collapse collapse show align-items-center">
                                <div class="accordion-body px-4">

                                    {{-- Informasi Termin --}}
                                    <div class="row g-3 justify-content-center mb-4">
                                        <div class="col-auto">
                                            <div class="d-flex flex-column border border-dashed p-3 rounded text-center">
                                                <small class="text-muted">Termin</small>
                                                <h4 class="mb-0">Termin {{ $termin->termin }}</h4>
                                            </div>
                                        </div>

                                        <div class="col-auto">
                                            <div class="d-flex flex-column border border-dashed p-3 rounded text-center">
                                                <small class="text-muted">Nominal</small>
                                                <h4 class="mb-0">Rp. {{ number_format((float) str_replace(',', '.', $termin->nominal), 2, ',', '.') }}</h4>
                                            </div>
                                        </div>

                                        <div class="col-auto">
                                            <div class="d-flex flex-column border border-dashed p-3 rounded text-center">
                                                <small class="text-muted">Status</small>
                                                <h4 class="mb-0">
                                                    @if($header['status'] == 1)
                                                    <a href="javascript:void(0);" class="stretched-link text-decoration-none text-success">
                                                        <i class="ri-bookmark-3-line" style="font-size: 24px;" data-bs-toggle="tooltip" title="Terbayar"></i><br>
                                                        Terbayar
                                                    </a>
                                                    @else
                                                    <a href="javascript:void(0);" class="stretched-link text-decoration-none text-muted">
                                                        <i class="ri-bookmark-3-line" style="font-size: 24px;" data-bs-toggle="tooltip" title="Belum Dibayar"></i><br>
                                                        Belum Dibayar
                                                    </a>
                                                    @endif
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Textarea & File Upload --}}
                                    <div class="row g-3 justify-content-center">
                                        <div class="col-md-6">
                                            <div class="border border-dashed p-3 rounded">
                                                <label for="catatan{{ $termin->termin }}" class="form-label">Catatan Tambahan</label>
                                                <textarea id="catatan{{ $termin->termin }}" class="form-control" rows="3" placeholder="Tulis catatan di sini..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="border border-dashed p-3 rounded">
                                                <label for="upload{{ $termin->termin }}" class="form-label">Upload Dokumen</label>
                                                <input type="file" class="form-control upload-file" data-preview="preview{{ $termin->termin }}" multiple>
                                                <div id="preview{{ $termin->termin }}" class="mt-3 d-flex gap-2 flex-wrap preview-area"></div>

                                            </div>
                                        </div>
                                        <!-- <div class="text-center"> -->
                                        <button class="btn   btn-primary">Update Status Termin {{ $termin->termin }}</button>
                                        <!-- </div> -->
                                    </div>
                                </div>
                            </div>
                        </div> {{-- end accordion --}}
                    </div>
                </div>
                @endforeach

            </div>
        </div><!-- end card body -->
    </div><!-- end card -->
</div><!-- end col -->
</div><!-- end row -->

</div> <!-- END TERMIN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const uploadInputs = document.querySelectorAll('.upload-file');

        uploadInputs.forEach((input) => {
            input.addEventListener('change', function() {
                const previewId = this.dataset.preview;
                const preview = document.getElementById(previewId);
                const selectedFiles = Array.from(this.files);

                preview.innerHTML = ''; // clear preview area

                selectedFiles.forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const wrapper = document.createElement('div');
                        wrapper.className = 'position-relative border rounded p-1';
                        wrapper.style.width = '100px';

                        const removeBtn = document.createElement('button');
                        removeBtn.innerHTML = '&times;';
                        removeBtn.className = 'btn btn-sm btn-danger position-absolute top-0 end-0';
                        removeBtn.style.zIndex = '10';
                        removeBtn.type = 'button';
                        removeBtn.onclick = () => {
                            selectedFiles.splice(index, 1);
                            showPreview(selectedFiles, preview);
                        };

                        let content;
                        if (file.type.startsWith('image/')) {
                            content = document.createElement('img');
                            content.src = e.target.result;
                            content.className = 'img-fluid rounded';
                        } else {
                            content = document.createElement('div');
                            content.innerText = file.name;
                        }

                        wrapper.appendChild(removeBtn);
                        wrapper.appendChild(content);
                        preview.appendChild(wrapper);
                    };
                    reader.readAsDataURL(file);
                });
            });

            function showPreview(files, previewElement) {
                previewElement.innerHTML = '';
                files.forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const wrapper = document.createElement('div');
                        wrapper.className = 'position-relative border rounded p-1';
                        wrapper.style.width = '100px';

                        const removeBtn = document.createElement('button');
                        removeBtn.innerHTML = '&times;';
                        removeBtn.className = 'btn btn-sm btn-danger position-absolute top-0 end-0';
                        removeBtn.style.zIndex = '10';
                        removeBtn.type = 'button';
                        removeBtn.onclick = () => {
                            files.splice(index, 1);
                            showPreview(files, previewElement);
                        };

                        let content;
                        if (file.type.startsWith('image/')) {
                            content = document.createElement('img');
                            content.src = e.target.result;
                            content.className = 'img-fluid rounded';
                        } else {
                            content = document.createElement('div');
                            content.innerText = file.name;
                        }

                        wrapper.appendChild(removeBtn);
                        wrapper.appendChild(content);
                        previewElement.appendChild(wrapper);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });
    });
</script>



@endsection