 
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

    <h3>Menu List</h3>
    
    <ul class="list-group" id="menu-list">
    @foreach($menus as $menu)
        <li class="list-group-item" data-id="{{ $menu->id }}">
            <strong>{{ $menu->name }}</strong>
            <small>({{ $menu->url }})</small>

            @if($menu->children->count())
                <ul class="list-group">
                    @foreach($menu->children as $child)
                        <li class="list-group-item" data-id="{{ $child->id }}">
                            <strong>{{ $child->name }}</strong>
                            <small>({{ $child->url }})</small>

                            @if($child->children->count())
                                <ul class="list-group">
                                    @foreach($child->children as $grandChild)
                                        <li class="list-group-item" data-id="{{ $grandChild->id }}">
                                            {{ $grandChild->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>


</div> 

<style>
    .list-group-item ul {
    margin-top: 10px;
    padding-left: 20px;
}

</style>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>



<script>
document.addEventListener('DOMContentLoaded', function () {
    const menuList = document.getElementById('menu-list');

    // Inisialisasi Sortable.js untuk list utama
    new Sortable(menuList, {
        group: 'nested', // Support untuk nested group
        animation: 150,
        fallbackOnBody: true,
        swapThreshold: 0.65,
        onEnd: function (evt) {
            updateMenuOrder(menuList);
        }
    });

    // Inisialisasi semua list child
    document.querySelectorAll('.list-group').forEach(function (list) {
        new Sortable(list, {
            group: 'nested',
            animation: 150,
            fallbackOnBody: true,
            swapThreshold: 0.65,
            onEnd: function (evt) {
                updateMenuOrder(menuList);
            }
        });
    });

    // Fungsi untuk mengirim data ke server
    function updateMenuOrder(menuList) {
        const orderedData = [];

        // Rekursif untuk memproses nested menu
        function processList(list, parentId = null) {
            list.querySelectorAll('.list-group-item').forEach((item, index) => {
                orderedData.push({
                    id: item.dataset.id,
                    position: index + 1,
                    parent_id: parentId
                });

                // Cari child list di dalam item ini
                const childList = item.querySelector('.list-group');
                if (childList) {
                    processList(childList, item.dataset.id);
                }
            });
        }

        processList(menuList);

        // Kirim data ke server
        fetch('{{ route("menus.updateOrder") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ data: orderedData })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Menu order updated successfully!');
            } else {
                alert('Failed to update menu order.');
            }
        })
        .catch(error => console.error('Error:', error));
    }
});
</script>





