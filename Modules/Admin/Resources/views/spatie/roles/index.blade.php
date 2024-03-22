@extends('layouts.master')
@section('css')
@endsection
@section('content')

    <div class="content">
        <div class="container-fluid">
            @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),'active'=>'ACL'],
            'pTitle' => 'Roles'])


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-xl-8">
                                </div>
                                <div class="col-xl-4">
                                    <div class="text-xl-end mt-xl-0 mt-2">
                                        <a href="{{route('acl.roles.create')}}" class="btn btn-info mb-2 me-2"
                                           data-toggle="tooltip" title="Add New Role"> <i
                                                class="mdi mdi-plus me-1"></i>{{translate('Add New')}} {{translate('Roles')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap mb-0 table-striped table-bordered"
                                       id="dataTable">
                                    <thead class="table-light">
                                    <tr>
                                        <th>{{translate('Sl')}}</th>
                                        <th>{{translate('Role Name')}}</th>
                                        <th>{{translate('Guard name')}}</th>
                                        <th>{{translate('Action')}}</th>
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


    <div class="modal fade permission" id="roleAndPermissionModal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-info">
                    <h4 class="modal-title " id="myLargeModalLabel">{{translate('Role with allowed Permission')}}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>

                <div class="modal-body" id="dataBody">

                </div>

            </div>
        </div>
    </div>
@endsection

@section('javascript')

    <script>

        function showRoleWithPermission(roleId) {
            $('#dataBody').empty().load('{{url(Request()->route()->getPrefix()."/roles")}}/' + roleId);
            $('#roleAndPermissionModal').modal('show');
        }


        $(function () {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                "lengthMenu": [[50, 100, 200, 500, -1], [50, 100, 200, 500, 1000, "All"]],
                ajax: '{{ url("admin/acl/roles-data") }}',
                columns: [
                    {data: 'DT_RowIndex', orderable: true},
                    {data: 'name', name: 'roles.name'},
                    {data: 'guard_name', name: 'roles.guard_name'},
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
    </script>
@endsection
