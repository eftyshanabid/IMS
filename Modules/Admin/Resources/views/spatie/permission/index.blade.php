@extends('layouts.master')
@section('css')
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),'active'=>'ACL'],
            'pTitle' => 'Permission'])
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-xl-8">
                                </div>
                                <div class="col-xl-4">
                                    <div class="text-xl-end mt-xl-0 mt-2">
                                        <a href="javascript:void(0)" class="btn btn-success mb-2 me-2"
                                           data-toggle="tooltip" title="Add New Permission" id="addPermissionBtn"> <i
                                                class="mdi mdi-plus me-1"></i>{{translate('Add New')}} {{translate('Permission')}}
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap mb-0" id="dataTable">
                                    <thead class="table-light">
                                    <tr>
                                        <th>SL</th>
                                        <th>Permission Name</th>
                                        <th>Guard name</th>
                                        <th>Module</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade permission" id="permissionModal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-info">
                    <h4 class="modal-title " id="myLargeModalLabel">{{translate('Add New')}} {{translate('Permission')}}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                {!! Form::open(array('route' => 'acl.permission.store','id'=>'permissionForm','class'=>'form-horizontal','method'=>'POST','role'=>'form')) !!}

                <div class="modal-body">
                    <div class="form-group row">
                        <label for="module" class="control-label col-md-12"><strong>{{translate('Module')}} <span class="text-danger">&nbsp;*</span></strong></label>
                        <div class="col-md-12 mb-3">
                            <input type="text" list="modules" name="module" id="module" class="form-control">
                            <datalist id="modules">
                                @if(isset($modules[0]))
                                    @foreach($modules as $key => $module)
                                        <option value="{{ $module }}">
                                    @endforeach
                                @endif
                            </datalist>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="permission" class="control-label col-md-12"><strong>{{translate('Permission')}} <span
                                    class="text-danger">&nbsp;*</span></strong></label>
                        <div class="col-md-12">
                            {!! Form::Select('name[]', [] ,old('name'),['id'=>'permission','multiple' => true, 'required'=>true,'class'=>'form-control rounded','style'=>'width:100%']) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">{{translate('Close')}}</button>
                    <button type="submit" class="btn btn-sm btn-primary text-white rounded"
                            id="requisitionTypeFormSubmit">{{ __('Save') }}</button>
                </div>
                {!! Form::close(); !!}
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

@endsection

@section('javascript')
    <script>
        $(document).ready(function () {
            $("#permission").select2({
                tags: true,
                placeholder: "Type permission name and hit enter",
                allowClear: true,
                dropdownParent: $('.permission')

            });
        });

        $('#menuId').on('change', function () {
            let menuId = 0;
            menuId = $(this).val()
            $('#submenuList').empty().load('{{url(Request()->route()->getPrefix()."/permission")}}/' + menuId);
        })
    </script>
    <script>
        $(function () {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                "lengthMenu": [[50, 100, 200, 500, -1], [50, 100, 200, 500, 1000, "All"]],
                ajax: '{{ url("admin/acl/permission/create") }}',
                columns: [
                    {data: 'DT_RowIndex', orderable: true},
                    {data: 'name', name: 'permissions.name'},
                    {data: 'guard_name', name: 'permissions.guard_name'},
                    {data: 'module', name: 'permissions.module'},
                    {data: 'action'},
                ]
            });

        });

        function deleteConfirm(id) {
            swal({
                title: "{{__('Are you sure?')}}",
                text: "You won't be able to revert this!",
                icon: "warning",
                dangerMode: true,
                buttons: {
                    cancel: true,
                    confirm: {
                        text: "Yes, delete it!",
                        value: true,
                        visible: true,
                        closeModal: true
                    },
                },
            }).then((result) => {
                if (result) {
                    $("#" + id).submit();
                }
            })
        }

        function editPermission(id) {
            $('#' + id).modal('show');
        }

        $('#addPermissionBtn').on('click', function () {
            $('#permissionModal').modal('show');
        });
    </script>
@endsection
