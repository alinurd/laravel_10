@extends('layouts.dashboard.app')
@section('title', $title)
@section('breadcrumb')
<x-dashboard.breadcrumb title="{{ $page }}" page="{{$menuParent}}" active="{{$title}}" route="" />
@endsection

@section('content')
<h1>{{$menuParent}}</h1>
@endsection
