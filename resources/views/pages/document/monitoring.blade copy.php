@extends('components.layouts.app')

@section('title', 'Monitoring Termin')

@section('breadcrumb')
<x-dashboard.breadcrumb title="Monitoring Termin" page="{{$header['kode']}}" active="Termin {{$terminid}}" route="#" />
@endsection

@section('content')
<div class="card card-height-100 table-responsive">
    <!-- cardheader -->
    <div class="card-header border-bottom-dashed align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">User</h4>
        <div class="flex-shrink-0">
            <button type="button" class="btn btn-soft-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-form-add-user">
                <i class="ri-add-line"></i>
                Add
            </button>
        </div>
    </div>
    documenctferifyreview
    <!-- end cardheader -->
    <!-- Hoverable Rows -->
    <table class="table table-hover table-nowrap mb-0">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Verified</th>
                <th scope="col" class="col-1"></th>
            </tr>
        </thead>
        
    </table>
    <div class="card-footer py-4">
        <nav aria-label="..." class="pagination justify-content-end"> 
        </nav>
    </div>
</div>
 
@endsection