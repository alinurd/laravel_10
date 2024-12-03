
<div id="menu-container" class="container">
    <ul id="menu-list" class="list-unstyled">
        @foreach ($menus as $menu)
            <li class="menu-item card mb-2" data-id="{{ $menu->id }}">
                <div class="card-body">
                    <strong>{{ $menu->name }}</strong>
                </div>
                @if ($menu->children->isNotEmpty())
                    <ul class="menu-children list-unstyled ms-3">
                        @foreach ($menu->children as $child)
                            <li class="menu-item card mb-2" data-id="{{ $child->id }}">
                                <div class="card-body">
                                    {{ $child->name }}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const menuList = document.getElementById("menu-list");

    // Fungsi untuk inisialisasi Sortable pada list menu dan semua child
    function initializeSortable(container) {
        Sortable.create(container, {
            group: 'nested',
            animation: 150,
            fallbackOnBody: true,
            swapThreshold: 0.65,
            onEnd: function (event) {
                const updatedMenu = getMenuData(menuList);
                updateMenuOrder(updatedMenu);
            }
        });

        // Inisialisasi Sortable untuk setiap nested children
        container.querySelectorAll('.menu-children').forEach(childContainer => {
            initializeSortable(childContainer);
        });
    }

    // Panggil fungsi untuk inisialisasi
    initializeSortable(menuList);

    // Fungsi untuk mengubah elemen HTML ke array data
    function getMenuData(container) {
        const items = Array.from(container.children);
        return items.map((item, index) => {
            const id = item.dataset.id;
            const parentId = item.closest('.menu-children')?.parentNode?.dataset.id || null;
            const childrenContainer = item.querySelector('.menu-children');
            const children = childrenContainer ? getMenuData(childrenContainer) : [];

            return { id, parent_id: parentId, position: index + 1, children };
        });
    }

    // Kirim data ke server
    function updateMenuOrder(data) {
        fetch('/menu/update-order', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({ data })
        })
        .then(response => response.json())
        .then(data => console.log('Menu updated:', data))
        .catch(error => console.error('Error updating menu:', error));
    }
});
</script>
