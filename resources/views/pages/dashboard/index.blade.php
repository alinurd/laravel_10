@extends('components.layouts.app')

@section('title', 'Dashboard')

@section('jSchart')
<script src="{{ $chartBar->cdn() }}"></script>
<script src="{{ $chartLine->cdn() }}"></script>
{{ $chartBar->script() }}
{{ $chartLine->script() }}
@endsection

@section('breadcrumb')
<x-dashboard.breadcrumb
    :title="'Dashboard'"
    :page="'Dashboard'"
    :active="'Dashboard'"
    :route="route('dashboard.index')" />
@endsection
@section('content')
<div class="card card-height-100 ">
    <div class="card-body">
             <form method="GET" action="{{ route('dashboard.index') }}">
                <div class="input-group">
                    <select name="year" class="form-select" id="inputGroupSelect04" aria-label="Example select2 with button addon">
                        <option value="" disabled selected>Pilih Tahun...</option>
                        <option value="2025" {{ request()->get('year') == '2025' ? 'selected' : '' }}>2025</option>
                        <option value="2024" {{ request()->get('year') == '2024' ? 'selected' : '' }}>2024</option>
                        <option value="2023" {{ request()->get('year') == '2023' ? 'selected' : '' }}>2023</option>
                    </select>
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </div>
            </form> 
    </div>
</div>
</div>
<div class="row row-cols-1 row-cols-md-2 g-4">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Total Sertifikat Tahunan</h5>
                <div class="p-6 m-20 bg-white rounded shadow">
                    {!! $chartBar->container() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <div class="col">
                        <div class="card bg-primary text-white">
                            <div class="card-body ">
                                <span class="card-title">Total Sertifikat</span>
                                <center>
                                    <h3 class="card-text text-white"><strong>{{$totalSerti}}</strong></h3>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <span class="card-title">Total Approved</span>
                                <center>
                                    <h3 class="card-text text-white"><strong>{{$totalApprv}}</strong></h3>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card bg-warning text-white">
                            <div class="card-body">
                                <span class="card-title">Total Review</span>
                                <center>
                                    <h3 class="card-text text-white"><strong>{{$totalReview}}</strong></h3>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card bg-danger text-white">
                            <div class="card-body">
                                <span class="card-title">Total Reject</span>
                                <center>
                                    <h3 class="card-text text-white"><strong>{{$totalReject}}</strong></h3>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">Total Nilai Barang {{ $year ? $year : '[all data]' }}</h5>
                        <center>
                                <h2 class="card-text"><strong>Rp. {{ number_format($totalNilaiProduct, 2, ',', '.') }}</strong></h2>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Total Nominal Sertifikat Tahunan</h5>
            {!! $chartLine->container() !!}

        </div>
    </div>
</div>
@endsection