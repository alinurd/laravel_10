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
        <button type="submit" class="btn btn-primary">Add Menu</button>
    </form>

    <hr>
    <h3>list menu</h3>
    

<div id="menu-tree"></div>

@endsection
<!-- Tambahkan CSS jsTree -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/themes/default/style.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!-- Tambahkan JS jsTree -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/jstree.min.js"></script>

<script>
    $(document).ready(function () {
     const treeData = @json($tree);  // Data tree yang sudah diproses di controller

    $('#menu-tree').jstree({
        plugins: ["wholerow", "checkbox", "types"], // Aktifkan plugin
        core: {
            themes: { responsive: false },
            data: treeData // Data tree yang dikirim dari controller
        },
        types: {
            default: { icon: "fa fa-folder text-warning" },
            file: { icon: "fa fa-file text-info" }
        },
        checkbox: {
            tie_selection: false, // Pastikan checkbox independen dari seleksi node
            whole_node: false,    // Memilih seluruh baris untuk checkbox
            keep_selected_style: false // Hilangkan gaya default pada node yang terpilih
        }
    });
 
 
// Event ketika checkbox berubah status
$('#menu-tree').on("check_node.jstree uncheck_node.jstree", function (e, data) {
    if (data.node) {
        const menuId = data.node.id;
        const isActive = data.node.state.checked ? 1 : 0;

        console.log("Menu ID:", menuId);
        console.log("Is Active:", isActive);

        // Kirim data status aktif/nonaktif ke server
        $.ajax({
            url: '{{ route("menus.updateStatus") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: menuId,
                is_active: isActive,
            },
            success: function (response) {
                if (response.success) {
                    alert("Status updated successfully!");
                } else {
                    alert("Failed to update status.");
                }
            },
            error: function (xhr, status, error) {
                console.error("Error updating status:", error);
            }
        });
    }
});


    // Event drag-and-drop selesai
    $('#menu-tree').on("move_node.jstree", function (e, data) {
        const movedNode = data.node;
        const newParent = data.parent;
        const position = data.position;

        // Kirim data ke server untuk update parent dan posisi
        $.ajax({
            url: '{{ route("menus.updateTree") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: movedNode.id,
                parent_id: newParent === "#" ? null : newParent,
                position: position,
            },
            success: function (response) {
                if (response.success) {
                    alert("Tree updated successfully!");
                } else {
                    alert("Failed to update tree.");
                }
            },
            error: function (xhr, status, error) {
                console.error("Error updating tree:", error);
            }
        });
    });
});
</script>

 
