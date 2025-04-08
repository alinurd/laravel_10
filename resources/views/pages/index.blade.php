@extends('components.layouts.app')
@section('title', $title)
@section('costum', isset($costum)??'')
@section('dataDetail', isset($dataDetail)??'')
@section('mode', $mode = $mode ?? 'list')
@section('sessionOK', $ses['sessionOK'] = $ses['sessionOK'] ?? "gajalan")

@section('breadcrumb')
<x-dashboard.breadcrumb title="{{ $page }}" page="{{$parentName}} > {{$title}}" active="{{ __('global.ket_' . $mode) }} " route="" />

@endsection
@section('content')

@if(isset($ses['failed']))
<div class="alert alert-danger">
    {{ $ses['failed'] }}
</div>
@endif

<div class="card card-height-100 ">
    <!-- cardheader -->
    <div class="card-header border-bottom-dashed align-items-center d-flex">
        <div class="row w-100">
            <div class="d-flex gap-2">
                <x-dashboard.ActionHeader currentRoute="{{$currentRoute}}" />
            </div>
        </div>
    </div>

    <!-- end cardheader -->
    <!-- Hoverable Rows -->
    <div class="table-responsive m-3">
        @include('components.form.default.filter')
        @if($mode !='add' && $mode !='edit'&& $mode !='show')

        <table class="display" id="data-tables">
            <thead>
                <tr style="background-color: #1B85F6; border-right: 1px solid #FFFFFF; color:#FFFFFF">
                    <th scope="col" class="text-center" width="50px">
                        <input type="checkbox" class="" name="check[]" id="{{__('global.no')}}">&nbsp;
                        {{__('global.no')}}
                    </th>

                    @forelse ($list as $l)
                    @if($l['showList']==true)
                    <th scope="col" style="text-align: {{$l['position']}}">{{ $l['label'] }}</th>
                    @endif
                    @empty
                    <th colspan="3" class="text-center">No data available</th>
                    @endforelse
                    <th scope="col" class="col-1" class="text-center">{{__('global.action')}}</th>
                </tr>
            </thead>
            <tbody>
                @if(count($field)>0)
                @forelse ($field as $f)

                <tr>
                    <th scope="row" class="">
                        <input type="checkbox" class="m-2" name="check[]" id="{{__('global.no')}}">&nbsp;
                        {{ $loop->iteration }}
                    </th>
                    @forelse ($list as $l)

                    @if($l['showList'] == true)
                    <td style="text-align: {{$l['position']}}">
                        @if($l['type'] == 'select')
                        @php $matchFound = false; @endphp
                        @foreach($l['option'] as $option)
                        @if($option['id'] == $f[$l['field']])
                        {{$option['value']}}
                        @php $matchFound = true; @endphp
                        @break
                        @endif
                        @endforeach
                        @if(!$matchFound)
                        {{$f[$l['field']] ?? 'unknown'}}
                        @endif
                        @elseif($l['input'] == 'rupiah')
                        {{ format_rupiah($f[$l['field']]) }}

                        @elseif($l['type'] == 'file')
                        @php
                        $fileData = json_decode($f[$l['field']], true);
                        @endphp

                        @php
                        $fileData = json_decode($f[$l['field']], true);
                        @endphp

                        @php
                        $fileKosong = empty($fileData['random_name']);
                        @endphp

                        <span class="btn {{ $fileKosong ? 'btn-warning' : 'btn-primary' }} ShowLampiran"
                            data-file="{{ $fileData['random_name'] ?? '' }}"
                            data-original="{{ $fileData['original_name'] ?? '' }}">
                            {{ $fileData['original_name'] ?? 'Tidak ada file' }}
                        </span>
 



                        @elseif($l['input'] == 'date')
                        {{ format_date($f[$l['field']]) }}

                        @elseif($l['field'] == 'status')
                        @if($f[$l['field']] == 1 || $f[$l['field']] == "active" || $f[$l['field']] == "show")
                        <span class="badge rounded-pill bg-primary">Aktif</span>
                        @elseif($f[$l['field']] == 2 || $f[$l['field']] == "inactive")
                        <span class="badge rounded-pill bg-danger">No-Aktif</span>
                        @elseif($f[$l['field']] == 3 || $f[$l['field']] == "show")
                        <span class="badge rounded-pill bg-warning">Show</span>
                        @elseif($f[$l['field']] == 0 || $f[$l['field']] == "")
                        <span class="badge rounded-pill bg-dark">Unknow</span>
                        @else
                        {{ format_date($f[$l['field']]) }}
                        @endif
                        @else
                        {{$f[$l['field']] ?? '-'}}
                        @endif

                    </td>
                    @endif

                    @empty
                    <td colspan="{{ count($list) }}" class="text-center">{{__('global.empt')}}</td>
                    @endforelse
                    <td class="text-center">
                        <x-dashboard.ActionList currentRoute="{{$currentRoute}}" id="{{$f->id}}" />
                    </td>
                </tr>
                @empty
                @endif

                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th scope="col">
                        <input type="checkbox" name="check[]" id="{{__('global.no')}}">&nbsp;
                        {{__('global.no')}}
                    </th>
                    @forelse ($list as $l)
                    @if($l['showList']==true)
                    <th scope="col" style="text-align: {{$l['position']}}">{{ $l['label'] }}</th>
                    @endif
                    @empty
                    @endforelse
                    <th scope="col" class="col-1" class="text-center">{{__('global.action')}}</th>
                </tr>
            </tfoot>
        </table>

        @endif
    </div>

    <div class="card-footer py-4">
        <nav aria-label="..." class="pagination justify-content-end">
        </nav>
    </div>
</div>
@endsection