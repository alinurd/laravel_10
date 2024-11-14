@extends('components.layouts.app')
@section('title', $title)
@section('mode', $mode = $mode ?? 'list')
@section('stm',true)
@section('menuGroup',$menuGroup)
@section('sessionOK', $ses['sessionOK'] = $ses['sessionOK'] ?? "gajalan")

@section('breadcrumb')
<x-dashboard.breadcrumb title="{{ $page }}" page="{{$title}}" active="{{ __('global.ket_' . $mode) }} " route="" />
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
                <a href=" {{ route($currentRoute.'.create') }} " class="btn btn-primary btn-md">
                    <i class="ri-add-line"></i>
                    {{ __('global.add_new') }}
                </a>
                <button type="button" class="btn btn-info btn-md" data-bs-toggle="modal" data-bs-target="#modal-form-print">
                    <i class="ri-printer-line"></i>
                    {{ __('global.print') }}
                </button>
                <button type="button" class="btn btn-danger btn-md" data-bs-toggle="modal" data-bs-target="#modal-form-delete">
                    <i class="ri-delete-bin-line"></i>
                    {{ __('global.del') }}
                </button>
                <button type="button" class="btn btn-success btn-md" data-bs-toggle="modal" data-bs-target="#filter">
                    <i class="ri-filter-3-line"></i>
                    {{ __('global.filter') }}
                </button>
            </div>

        </div>
    </div>

    <!-- end cardheader -->
    <!-- Hoverable Rows -->
    <div class="table-responsive m-3">
    @include('components.form.stm.filter')
        @if($mode !='add' && $mode !='edit')
         
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
                @if(count($field)>0)
                @forelse ($field as $f)
                @php
                $id=$f['id'];
                @endphp
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
                                <i class="ri-list-check"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li>
                                    <a class="text-info dropdown-item" href="{{ route($currentRoute . '.edit', [$currentRoute => $id]) }}">
                                        <i class="ri-edit-line text-info"></i> {{__('global.edit')}}
                                    </a>
                                </li>
                                <li>
                                    <a class="text-danger dropdown-item">
                                        <form action="{{ route($currentRoute . '.destroy', [$currentRoute => $id]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger dropdown-item" style="background:none;border:none;padding:0;">
                                                <i class="ri-delete-bin-2-line text-danger"></i> {{ __('global.del') }}
                                            </button>
                                        </form>
                                    </a>
                                </li>
                            </ul>
                        </div>
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
                    @if($l['show']==true)
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