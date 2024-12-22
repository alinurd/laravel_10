<tr>
<td style="padding-left: {{ $level * 35 }}px;">
    <i class="ri-checkbox-blank-circle-line"></i> &ensp; <strong style="margin-right: 7px;">
                  <i class="{{ $i->icon }}" ></i>
                  &ensp;{{ $i->name }}
                </strong>
                [<i style="color: rgb(0, 125, 243); margin: 5px;">{{ $i->url }}</i>]
    </td>
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
    @include('components.form.stm.child', ['g' => $g, 'i' => $child, 'level' => $level + 1]) <!-- Rekursif untuk child -->
@endforeach


