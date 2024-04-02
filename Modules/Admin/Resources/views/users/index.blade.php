@extends('layouts.master')
@section('css')
    @include('yajra.css')
@endsection
@section('content')

    <div class="content">
        <div class="container-fluid">
            @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),'active'=>'ACL'],
            'pTitle' => 'Users'])

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-xl-8">
                                </div>
                                <div class="col-xl-4">
                                    <div class="text-xl-end mt-xl-0 mt-2">
                                        <a href="{{route('acl.users.create')}}" class="btn btn-info mb-2 me-2"
                                           data-toggle="tooltip" title="Add New User"> <i
                                                class="mdi mdi-plus me-1"></i>{{translate('Add New User')}}</a>

                                        {{--<a href="{{route('pms.admin.users.deleted')}}" class="btn btn-sm btn-danger text-white" data-toggle="tooltip" title="Active Users"> <i class="las la-ban"></i>View Deleted Users</a> --}}

                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                @include('yajra.datatable')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-md" id="showUserDetailsModal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-info">
                    <h4 class="modal-title " id="myLargeModalLabel">{{translate('User Details')}}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>

                <div class="modal-body" id="dataBody">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    @include('yajra.js')
    <script>
        function showUserDetails(userId) {
            $('#dataBody').empty().load('{{url(Request()->route()->getPrefix()."/users")}}/' + userId);
            $('#showUserDetailsModal').modal('show');
        }
    </script>
@endsection
