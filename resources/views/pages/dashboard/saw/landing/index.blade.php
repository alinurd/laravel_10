@extends('components.layouts.sawLanding')

@section('title', 'SAW Method - Penilaian Alternatif')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            @include('pages.dashboard.saw.landing._header')
            @include('pages.dashboard.saw.landing._user_identity')
            @include('pages.dashboard.saw.landing._evaluation_form')
            @includeWhen(session('hasil'), 'pages.dashboard.saw.landing._results')
        </div>
    </div>
</div>

@include('pages.dashboard.saw.landing._modals')
@endsection


            @include('pages.dashboard.saw.landing._scripts')
            @include('pages.dashboard.saw.landing._css')


   
   
