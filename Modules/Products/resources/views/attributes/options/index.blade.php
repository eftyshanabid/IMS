@extends('layouts.master')
@section('css')
    @include('yajra.css')
@endsection
@section('content')

    <div class="content">
        <div class="container-fluid">
            @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),
            'active'=>'Products'],
            'pTitle' => 'Attribute Options'])

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-xl-8">
                                    <form action="{{ route('attribute-options.index') }}" method="get"
                                          accept-charset="utf-8">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="input-group input-group-md mb-1 d-">
                                                    <select name="attribute_id" id="attribute_id"
                                                            class="form-control rounded"
                                                            onchange="$(this).parent().parent().parent().parent().submit()">
                                                        <option value="0">Choose Attributes</option>
                                                        @if(isset($attributes[0]))
                                                            @foreach($attributes as $key => $attribute)
                                                                <option
                                                                    value="{{ $attribute->id }}" {{ request()->get('attribute_id') == $attribute->id ? 'selected' : '' }}>
                                                                    [{{ $attribute->code }}
                                                                    ] {{ $attribute->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                @if(request()->has('attribute_id') && request()->get('attribute_id') > 0)
                                                    @can('attribute-edit')

                                                        <a class="text-primary pl-1" onclick="openModal('Edit ' +
                                                         'Attribute', '{{ url('admin/attributes/'.request()->get
                                                         ('attribute_id').'/edit') }}');" style="font-size: 12px"><i
                                                                class="mdi mdi-pencil-box me-1"></i>&nbsp;Edit</a>
                                                    @endcan
                                                    @can('attribute-delete')
                                                        &nbsp;&nbsp;|&nbsp;&nbsp;
                                                        <a class="text-danger deleteBtn" data-reload="1"
                                                           data-src="{{ route('attributes.destroy', request()->get('attribute_id')) }}"
                                                           style="font-size: 12px"><i class="mdi mdi-delete
                                                           me-1"></i>&nbsp;Delete</a>
                                                        &nbsp;&nbsp;|&nbsp;&nbsp;
                                                    @endcan
                                                @endif
                                                @can('attribute-create')
                                                    <a class="text-success" onclick="openModal('New Attribute', '{{
                                                    url('admin/attributes/create') }}');" style="font-size: 12px"><i
                                                            class="mdi mdi-plus me-1"></i>&nbsp;New Attribute</a>
                                                @endcan
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-xl-4">
                                    <div class="text-xl-end mt-xl-0 mt-2">
                                        @if(isOptionPermitted('attribute-option-create'))
                                            <a href="{{ url('admin/attribute-options/create?attribute_id='.request()
                                            ->get('attribute_id')) }}"
                                               class="btn btn-info mb-2 me-2"
                                               data-toggle="tooltip" title="New Attribute Option">
                                                <i class="mdi mdi-plus me-1"></i>{{translate('New Attribute Option')
                                                }}</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                @if(request()->has('attribute_id'))
                                    @include('yajra.datatable')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-md" id="modal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-info">
                    <h4 class="modal-title" id="myLargeModalLabel">{{translate('Department Details')}}</h4>
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
        function showDetails(id) {
            $('#dataBody').empty().load('{{url(Request()->route()->getPrefix()."/departments")}}/' + id);
            $('#showUserDetailsModal').modal('show');
        }

        (function ($) {
            "use script";
            const showAlert = (status, error) => {
                swal({
                    icon: status,
                    text: error,
                    dangerMode: true,
                    buttons: {
                        cancel: false,
                        confirm: {
                            text: "OK",
                            value: true,
                            visible: true,
                            closeModal: true
                        },
                    },
                }).then((value) => {
                    if (value) form.reset();
                });
            };

            $('.deleteBtn').on('click', function () {
                var reload = $(this).attr('data-reload');
                swal({
                    title: "{{__('Are you sure?')}}",
                    text: "{{__('Once you delete, You can not recover this data and related files.')}}",
                    icon: "warning",
                    dangerMode: true,
                    buttons: {
                        cancel: true,
                        confirm: {
                            text: "Delete",
                            value: true,
                            visible: true,
                            closeModal: true
                        },
                    },
                }).then((value) => {
                    if (value) {
                        var button = $(this);
                        $.ajax({
                            type: 'DELETE',
                            url: $(this).attr('data-src'),
                            dataType: 'json',
                            success: function (response) {
                                if (response.success) {
                                    swal({
                                        icon: 'success',
                                        text: response.message,
                                        button: false
                                    });

                                    setTimeout(() => {
                                        if (reload == 1) {
                                            window.open("{{ url('admin/attribute-options') }}", "_parent");
                                        } else {
                                            swal.close();
                                        }
                                    }, 1500);

                                    button.parent().parent().remove();
                                } else {
                                    showAlert('error', response.message);
                                    return;
                                }
                            },
                        });
                    }
                });
            });
        })(jQuery)

        function openModal(title, link) {
            var modal = $('#modal');
            modal.modal('toggle');
            modal.find('.modal-title').html(title);
            modal.find('.modal-body').html('<h5 class="text-center">Please Wait...</h5>');
            $.ajax({
                url: link,
                type: 'GET',
                data: {},
            })
                .done(function (response) {
                    modal.find('.modal-body').html(response);
                });
        }
    </script>
@endsection
