@extends('layouts.dashboard.app')

@section('title', $title) <!-- Menggunakan $title langsung, karena kita kirimkan $title dalam $data -->

@section('breadcrumb')
<x-dashboard.breadcrumb title="{{ $title }}" page="Menu Management" active="Group" route="{{ route('menu.index') }}" />
@endsection

@section('content')
<h1>Icons</h1>
@endsection
