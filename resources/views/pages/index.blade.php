@extends('layouts.dashboard.app')
@section('title', $title)
@section('breadcrumb')
<x-dashboard.breadcrumb title="{{ $page }}" page="{{$menuParent}}" active="{{$title}}" route="" />
@endsection

@section('content')

<div class="card card-height-100 ">
    <!-- cardheader -->
    <div class="card-header border-bottom-dashed align-items-center d-flex">
         <div class="flex-shrink-0">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-form-add-permission">
                <i class="ri-add-line"></i>
                {{__('global.add_new')}}
            </button>
            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal-form-add-permission">
                <i class="ri-add-line"></i>
                {{__('global.print')}}
            </button>
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-form-add-permission">
                <i class="ri-add-line"></i>
                {{__('global.del')}}
            </button>
        </div>
    </div>
    <!-- end cardheader -->
    <!-- Hoverable Rows -->
    <div class="table-responsive m-3">
    <table class="display" id="data-tables">
    <thead>
        <tr>
            <th scope="col"class="text-center" >{{__('global.no')}}</th>
            
            @forelse ($list as $l)
                <th scope="col">{{ $l['label'] }}</th>
            @empty
                <th colspan="3" class="text-center">No data available</th>
            @endforelse
            <th scope="col" class="col-1" class="text-center">{{__('global.action')}}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($field as $f)
            <tr>
                <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                @forelse ($list as $l)
                    <td>{{ $f[$l['field']] }}</td>
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
</table>
    </div>

    <div class="card-footer py-4">
        <nav aria-label="..." class="pagination justify-content-end">
         </nav>
    </div>
</div>
@endsection



