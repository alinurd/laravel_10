@extends('components.layouts.default')
@section('title', 'Menu')

@section('breadcrumb')
<x-dashboard.breadcrumb title="Menu Management" page="Menu Management" active="Group" route="{{ route('menu.index') }}" />
@endsection

@section('content')
<div class="container">
    <h2>Menu Management</h2>
    <form method="POST" action="{{ route('menus.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Menu Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="url">URL</label>
            <input type="text" name="url" class="form-control">
        </div>
        <div class="form-group">
            <label for="icon">Icon</label>
            <input type="text" name="icon" class="form-control">
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
        <button type="submit" class="btn btn-primary mt-2">Add Menu</button>
    </form>

    <hr>
    <h3>list menu</h3>


    <div id="menu-tree"></div>
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
                            <input type="text" class="form-control" id="menu-name" >
                        </div>
                        <div class="mb-3">
                            <label for="menu-url" class="form-label">Route</label>
                            <input type="text" class="form-control" id="menu-url" >
                        </div>
                        <div class="mb-3">
                            <label for="menu-icon" class="form-label">Icon</label>
                            <input type="text" class="form-control" id="menu-icon" >
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
        
 


        $(document).ready(function() {
            const treeData = @json($tree);


            $('#menu-tree').jstree({
                'plugins': ["contextmenu", "dnd", "types"],
                'core': {
                    "themes": {
                        "responsive": false
                    },
                    'data': treeData,
                    check_callback: true,
                },
                "types": {
                    "default": {
                        "icon": "fa fa-folder text-warning"
                    },
                    "file": {
                        "icon": "fa fa-file text-info"
                    }
                },
            });
            // Event ketika node di klik
            $('#menu-tree').on("select_node.jstree", function(e, data) {
                console.log(data.node)
                const menuId = data.node.id;
                const menuName = data.node.text; 
                const menuStatus = data.node.state.selected ? 1 : 0; // Status berdasarkan seleksi node

                const menuUrl = data.node.original.url; // Akses dari original
                const menuIcn = data.node.original.ic; // Akses dari original              
                   $('#menu-name').val(menuName);
                $('#menu-url').val(menuUrl);
                $('#menu-icon').val(menuIcn);
                $('#menu-status').val(menuStatus);

                // Tampilkan modal untuk mengubah status
                $('#statusModal').modal('show');

                // Menyimpan status baru setelah diubah
                $('#saveStatus').on('click', function() {
                    const newStatus = $('#menu-status').val(); 

                    showSpinner('#statusModal .modal-body', '#saveStatus');

                    // Kirim data ke server untuk update status
                    $.ajax({
                        url: '{{ route("menus.updateStatus") }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: menuId,
                            is_active: newStatus,
                        },
                        success: function(response) {
                            removeSpinner('#statusModal .modal-body', '#saveStatus');
                                                        $('#saveStatus').prop('disabled', false);
                            if (response.success) {
                                alert("Status updated successfully!");
                                 $('#statusModal').modal('hide');
                                 $('#menu-tree').jstree("set_state", {
                                    selected: newStatus === "1"
                                });
                            } else {
                                alert("Failed to update status.");
                            }
                        },
                        error: function(xhr, status, error) {
                            removeSpinner('#statusModal .modal-body', '#saveStatus');
                            alert("Error: " + error);
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
        complete: function () {
            // Setelah request selesai, hapus spinner dan aktifkan tombol kembali
            removeSpinner('.jstree-children', '');
        }
                    
                });
            });
        });
    </script>

    <style>
        

    </style>