@extends('components.layouts.app')
@section('title', $title)
@section('mode', $mode = $mode ?? 'list')
@section('breadcrumb')
<x-dashboard.breadcrumb title="{{ $page }}" page="{{$menuParent}}" active="{{$title}}" route="" />
@endsection
@section('content')
    <div class="card card-height-100 ">
        <!-- cardheader -->
        <div class="card-header border-bottom-dashed align-items-center d-flex">
        <div class="row w-100">
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-form-add-permission">
                        <i class="ri-add-line"></i>
                        {{ __('global.add_new') }}
                    </button>
                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal-form-print">
                        <i class="ri-printer-line"></i>
                        {{ __('global.print') }}
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-form-delete">
                        <i class="ri-delete-bin-line"></i>
                        {{ __('global.del') }}
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal-form-filter">
                    <i class="ri-filter-3-line"></i>
                    {{ __('global.filter') }}
                </button>
                </div>
            
        </div>
    </div>

        <!-- end cardheader -->
        <!-- Hoverable Rows -->
        <div class="table-responsive m-3">
            <!-- <table cellpadding="3" cellspacing="0" border="0" style="width: 67%; margin: 0 auto 2em auto;">
                <thead>
                    <tr>
                        <th>Target</th>
                        <th>Search text</th>
                        <th>Treat as regex</th>
                        <th>Use smart search</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="filter_global">
                        <td>Global search</td>
                        <td align="center"><input type="text" class="global_filter" id="global_filter"></td>
                        <td align="center"><input type="checkbox" class="global_filter" id="global_regex"></td>
                        <td align="center"><input type="checkbox" class="global_filter" id="global_smart" checked="checked"></td>
                    </tr> 
                </tbody>
            </table> -->

            <table class="display" id="data-tables">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" width="50px">
                            <input type="checkbox" class="" name="check[]" id="{{__('global.no')}}">&nbsp;
                            {{__('global.no')}}
                        </th>

                        @forelse ($list as $l)
                        @if($l['show']==true)
                        <th scope="col" style="text-align: {{$l['position']}}">{{ $l['label'] }}</th>
                        @endif
                        @empty
                        <th colspan="3" class="text-center">No data available</th>
                        @endforelse
                        <th scope="col" class="col-1" class="text-center">{{__('global.action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($field as $f)
                    <tr>
                        <th scope="row" class="">
                            <input type="checkbox" class="m-2" name="check[]" id="{{__('global.no')}}">&nbsp;
                            {{ $loop->iteration }}
                        </th>
                        @forelse ($list as $l)
                        @if($l['show']==true)
                        <td style="text-align: {{$l['position']}}">{{ $f[$l['field']] }}</td>
                        @endif
                        @empty
                        <td colspan="{{ count($list) }}" class="text-center">{{__('global.empt')}}</td>
                        @endforelse
                        <td class="text-center">
                            <div class="dropdown">
                                <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-more-2-fill"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-form-edit-{{ $f['id'] }}">
                                            {{__('global.edit')}}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('form-delete-{{ $f['id'] }}').submit()">
                                            {{__('global.del')}}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ count($list) + 1 }}" class="text-center">{{__('global.emptyDisplay')}}</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                    <th scope="col" >
                            <input type="checkbox" name="check[]" id="{{__('global.no')}}">&nbsp;
                            {{__('global.no')}}
                        </th>
                        @forelse ($list as $l)
                        @if($l['show']==true)
                        <th scope="col" style="text-align: {{$l['position']}}">{{ $l['label'] }}</th>
                        @endif
                        @empty
                        <th colspan="3" class="text-center">No data available</th>
                        @endforelse
                        <th scope="col" class="col-1" class="text-center">{{__('global.action')}}</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="card-footer py-4">
            <nav aria-label="..." class="pagination justify-content-end">
            </nav>
        </div>
    </div>
@endsection