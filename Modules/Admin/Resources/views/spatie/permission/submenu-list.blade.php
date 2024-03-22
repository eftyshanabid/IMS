<select name="submenu_id" id="subMenuId" class="form-control" style="width: 100%;">
    <option>--Select Sub Menu--</option>
    @forelse($submenus as $submenu)

    <option value="{{$submenu->id}}">{{$submenu->name}} </option>

    @empty
    <option value="">No Sub Menu Data</option>

    @endforelse
</select>