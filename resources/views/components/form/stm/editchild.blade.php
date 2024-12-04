<tr>
    <td style="padding-left: {{ $level * 20 }}px;"><i class="ri-checkbox-blank-circle-line"></i> &ensp;<strong>{{ $i->name }}</strong></td>
    <td>
        <input type="checkbox" class="form-switch" name="manage[{{ $g->id }}][{{ $i->id }}]" id="manage_{{ $g->id }}_{{ $i->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Manage {{ $i->name }}">
    </td>
    <td>
        <input type="checkbox" class="form-switch" name="create[{{ $g->id }}][{{ $i->id }}]" id="create_{{ $g->id }}_{{ $i->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Create data {{ $i->name }}">
    </td>
    <td>
        <input type="checkbox" class="form-switch" name="delete[{{ $g->id }}][{{ $i->id }}]" id="delete_{{ $g->id }}_{{ $i->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete data {{ $i->name }}">
    </td>
    <td>
        <input type="checkbox" class="form-switch" name="update[{{ $g->id }}][{{ $i->id }}]" id="update_{{ $g->id }}_{{ $i->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Update data {{ $i->name }}">
    </td>
    <td>
        <input type="checkbox" class="form-switch" name="view[{{ $g->id }}][{{ $i->id }}]" id="view_{{ $g->id }}_{{ $i->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="View data {{ $i->name }}">
    </td>
</tr>
@foreach ($i->children as $child)
    @include('components.form.stm.editchild', ['g' => $g, 'i' => $child, 'level' => $level + 1]) <!-- Rekursif untuk child -->
@endforeach


