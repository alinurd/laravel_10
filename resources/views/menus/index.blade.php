 
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
    <ul class="list-group">
         @foreach($menus as $menu)
            <li class="list-group-item">
                <strong>{{ $menu->name }}</strong> 
                <small>({{ $menu->url }})</small>
                @if($menu->children->count())
                    <ul>
                        @foreach($menu->children as $child)
                            <li>{{ $child->name }}</li>
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