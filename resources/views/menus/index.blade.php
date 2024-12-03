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

<!-- Tambahkan JS jsTree -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/jstree.min.js"></script>

<script>
    $(document).ready(function () {
         const treeData = @json($tree);

         $('#menu-tree').jstree({
            core: {
                data: treeData,
                check_callback: true,  
            },
            plugins: ["dnd"], // Drag and Drop untuk mengubah posisi
        });

        // Tangani event perubahan tree
        $('#menu-tree').on("changed.jstree", function (e, data) {
            console.log("Selected node:", data.node);
        });

        // Tangani event drag-and-drop selesai
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


