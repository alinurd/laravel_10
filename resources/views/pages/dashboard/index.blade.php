@extends('components.layouts.app')

@section('title', 'Dashboard')

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
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <select name="" id="" class="select2 form-control">
                    <option value="">-Pilih Tahun-</option>
                    <option value="">2025</option>
                    <option value="">2024</option>
                    <option value="">2023</option>
                </select>
            </div>
            <button class="btn btn-primary">Search</button>
        </div>
    </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Sertifikat Tahunan</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
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
                                        <h3 class="card-text text-white"><strong>100</strong></h3>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <span class="card-title">Total Approved</span>
                                    <center>
                                        <h3 class="card-text text-white"><strong>100</strong></h3>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <span class="card-title">Total Review</span>
                                    <center>
                                        <h3 class="card-text text-white"><strong>100</strong></h3>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-danger text-white">
                                <div class="card-body">
                                    <span class="card-title">Total Reject</span>
                                    <center>
                                        <h3 class="card-text text-white"><strong>100</strong></h3>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Nilai Barang 2024</h5>
                                <center>
                                    <h3 class="card-text"><strong>25.000.000</strong></h3>
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
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
            </div>
        </div>
    </div>
    @endsection