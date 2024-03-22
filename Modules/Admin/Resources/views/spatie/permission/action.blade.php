<div class="modal fade permission" id="permissionModal{{  $permission->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info">
                <h4 class="modal-title" id="myLargeModalLabel">Permission Edit</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            {!! Form::open(array('route' => ['acl.permission.update',$permission->id],'class'=>'form-horizontal author_form','method'=>'PUT','files'=>'true', 'id'=>'commentForm','role'=>'form','data-parsley-validate novalidate')) !!}
            <div class="modal-body p-4">
                <div class="form-group row">
                    <label for="module"><strong>Module <span class="text-danger">&nbsp;*</span></strong></label>
                    <input type="text" list="modules" name="module" id="module" class="form-control" value="{{  $permission->module }}">
                    <datalist id="modules">
                        @if(isset($modules[0]))
                        @foreach($modules as $key => $module)
                        <option value="{{ $module }}">
                            @endforeach
                            @endif
                        </datalist>
                    </div>
                    <div class="form-group row">
                        <label for="name"><strong>Permission <span class="text-danger">&nbsp;*</span></strong></label>
                        <input class="form-control" type="text" id="name" name="name" value="{{  $permission->name }}" />
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-success">Update</button>
                </div>
                {!! Form::close(); !!}
            </div>
        </div>
    </div>

{!! Form::open(array('route'=> ['acl.permission.destroy', $permission->id],'method'=>'DELETE','class'=>'deleteForm','id'=>"deleteForm".$permission->id)) !!}
    {{ Form::hidden('id', $permission->id)}}
    {{-- @can('permission-edit') --}}
    <a type="button" onclick='return editPermission("permissionModal{{  $permission->id }}")' class="action-icon" data-toggle="modal"  title="Click to Edit"><i class="mdi mdi-square-edit-outline"></i></a>

   {{--  @endcan
    @can('permission-delete') --}}
    <a onclick='return deleteConfirm("deleteForm{{$permission->id}}");' class="action-icon"><i class="mdi mdi-delete"></i></a>
    {{-- @endcan --}}
{!! Form::close() !!}