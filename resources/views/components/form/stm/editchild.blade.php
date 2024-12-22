<tr>
    <td style="padding-left: {{ $level * 35 }}px;">
    <i class="ri-checkbox-blank-circle-line"></i> &ensp; <strong style="margin-right: 7px;">
                  <i class="{{ $i->icon }}" ></i>
                  &ensp;{{ $i->name }}
                </strong>
                [<i style="color: rgb(0, 125, 243); margin: 5px;">{{ $i->url }}</i>]
    </td>
    <td>
        <input type="checkbox" class="form-switch" name="manage[{{ $g->id }}][{{ $i->id }}]" 
               id="manage_{{ $g->id }}_{{ $i->id }}" data-bs-toggle="tooltip" 
               data-bs-placement="top" title="Manage {{ $i->name }}" 
               @if($itemPermissions && $itemPermissions['permission_types']['manage']) checked @endif>
    </td>
    <td>
        <input type="checkbox" class="form-switch" name="create[{{ $g->id }}][{{ $i->id }}]" 
               id="create_{{ $g->id }}_{{ $i->id }}" data-bs-toggle="tooltip" 
               data-bs-placement="top" title="Create {{ $i->name }}" 
               @if($itemPermissions && $itemPermissions['permission_types']['create']) checked @endif>
    </td>
    <td>
        <input type="checkbox" class="form-switch" name="delete[{{ $g->id }}][{{ $i->id }}]" 
               id="delete_{{ $g->id }}_{{ $i->id }}" data-bs-toggle="tooltip" 
               data-bs-placement="top" title="Delete {{ $i->name }}" 
               @if($itemPermissions && $itemPermissions['permission_types']['delete']) checked @endif>
    </td>
    <td>
        <input type="checkbox" class="form-switch" name="update[{{ $g->id }}][{{ $i->id }}]" 
               id="update_{{ $g->id }}_{{ $i->id }}" data-bs-toggle="tooltip" 
               data-bs-placement="top" title="Update {{ $i->name }}" 
               @if($itemPermissions && $itemPermissions['permission_types']['update']) checked @endif>
    </td>
    <td>
        <input type="checkbox" class="form-switch" name="view[{{ $g->id }}][{{ $i->id }}]" 
               id="view_{{ $g->id }}_{{ $i->id }}" data-bs-toggle="tooltip" 
               data-bs-placement="top" title="View {{ $i->name }}" 
               @if($itemPermissions && $itemPermissions['permission_types']['view']) checked @endif>
    </td>
</tr>

@foreach ($i->children as $child)
    @php
        // Memastikan itemPermissions sudah disaring dengan benar
        $itemPermissions = collect($groupPermission)->firstWhere('menu_item_id', $child->id);
    @endphp

    @include('components.form.stm.editchild', [
        'g' => $g, 
        'i' => $child, 
        'level' => $level + 1, 
        'itemPermissions' => $itemPermissions
    ])
@endforeach
