@extends('components.layouts.default')
@section('title', 'Menu')

@section('breadcrumb')
<x-dashboard.breadcrumb title="Menu Management" page="Menu Management" active="Group" route="{{ route('menu.index') }}" />
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <button class="addMenu btn btn-primary">Tambah Menu</button>
    </div>
    <div class="card-body">
        <center><div id="menu-tree"></div></center>
        <!-- Modal untuk update status -->
        <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusModalLabel">Update Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="statusForm">
                            <div class="mb-3">
                                <label for="menu-name" class="form-label">Menu Name</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="menu-url" class="form-label">Route</label>
                                <input type="text" class="form-control" id="url">
                            </div>
                            <div class="mb-3">
                                <label for="menu-icon" class="form-label">Icon</label>
                                <select name="icon" id="icon" class="form-control select2">
                                    @foreach($icon as $i)
                                    <option value="{{ $i->data }}">{{ $i->nama }} <strong>[ {{ $i->data }} ]</strong></option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="menu-status" class="form-label">Status</label>
                                <select class="form-select" id="menu-status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveStatus">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addMenu" tabindex="-1" aria-labelledby="addMenuLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addMenuLabel">Update Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('menus.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Menu Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="url">URL</label>
                                <input type="text" name="url" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="icon">Icon</label>
                                <select name="icon" class="form-control select2">
                                    @foreach($icon as $i)
                                    <option value="{{ $i->data }}">{{ $i->nama }} - {{ $i->data }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="parent_id">Parent Menu</label>
                                <select name="parent_id" class="form-control">
                                    <option value="">-- None --</option>
                                    @foreach($menus as $menu)
                                    <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="position">Position</label>
                                <input type="number" name="position" class="form-control" required>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                </form>
            </div>
        </div>

        <!-- Spinner -->
        <!-- <div id="loading-spinner" style="display: none;">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div> -->


        @endsection
        <!-- Tambahkan CSS jsTree -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/themes/default/style.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

        <!-- Tambahkan JS jsTree -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/jstree.min.js"></script>
        <script>
            function clearSelectedState(nodes) {
                nodes.forEach(node => {
                    if (node.state) {
                        node.state.selected = false;
                    }
                    if (node.children && node.children.length > 0) {
                        clearSelectedState(node.children);
                    }
                });
            }
            $(document).ready(function() {
                $(document).on('click', '.addMenu', function() {
                    $('#addMenu').modal('show');
                });



                const treeData = @json($tree);
                clearSelectedState(treeData);

                $('#menu-tree').jstree({
                    'plugins': ["contextmenu", "dnd", "types"],
                    'core': {
                        "themes": {
                            "responsive": false
                        },
                        'data': treeData,
                        'check_callback': true
                    },
                    "types": {
                        "default": {
                            "icon": "fa fa-folder text-warning"
                        },
                        "file": {
                            "icon": "fa fa-file text-info"
                        }
                    }
                });

                // Event ketika node di klik
                $('#menu-tree').on("select_node.jstree", function(e, data) {
                    const menuId = data.node.id;
                    const menuName = data.node.text;
                    const menuStatus = data.node.state.selected ? 1 : 0;

                    const menuUrl = data.node.original.url;
                    const menuIcn = data.node.original.ic;
                    let beforeDash = menuName.match(/^(.*?)(?= -)/);
                    $('#name').val(beforeDash ? beforeDash[0] : "No match found");
                    $('#url').val(menuUrl);
                    $('#icon').val(menuIcn);
                    $('#status').val(menuStatus);

                    $('#statusModal').modal('show');

                    // Menyimpan status baru setelah diubah
                    $('#saveStatus').off('click').on('click', function() {
                        const newStatus = $('#menu-status').val();
                        const url = $('#url').val();
                        const icon = $('#icon').val();
                        const name = $('#name').val();
console.log(icon)
                        showSpinner('#statusModal .modal-body', '#saveStatus');

                        $.ajax({
                            url: '{{ route("menus.updateStatus") }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: menuId,
                                is_active: newStatus,
                                name: name,
                                icon: icon,
                                url: url,
                            },
                            success: function(response) {
                                removeSpinner('#statusModal .modal-body', '#saveStatus');
                                if (response.success) {
                                    alert("Status updated successfully!");
                                    $('#statusModal').modal('hide');
                                } else {
                                    alert("Failed to update status.");
                                }
                            },
                            error: function(xhr, status, error) {
                                removeSpinner('#statusModal .modal-body', '#saveStatus');
                                console.error("Error updating status:", error);
                            }
                        });
                    });
                });

                // Event drag-and-drop selesai
                $('#menu-tree').on("move_node.jstree", function(e, data) {
                    const movedNode = data.node;
                    const newParent = data.parent;
                    const position = data.position;

                    showSpinner('.jstree-children', '');
                    $.ajax({
                        url: '{{ route("menus.updateTree") }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: movedNode.id,
                            parent_id: newParent === "#" ? null : newParent,
                            position: position,
                        },
                        success: function(response) {
                            if (response.success) {
                                alert("Tree updated successfully!");
                            } else {
                                alert("Failed to update tree.");
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error updating tree:", error);
                        },
                        complete: function() {
                            removeSpinner('.jstree-children', '');
                        }
                    });
                });
            });
        </script>