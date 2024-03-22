@extends('layouts.master')
@section('css')
@endsection
@section('content')

    <div class="content">
        <div class="container-fluid">

            @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),'active'=>'ACL'],
            'pTitle' => 'Users Create'])

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-xl-8">
                                </div>
                                <div class="col-xl-4">
                                    <div class="text-xl-end mt-xl-0 mt-2">
                                        <a href="{{route('acl.users.index')}}" class="btn btn-info mb-2 me-2"
                                           data-toggle="tooltip" title="Users List"> <i class="mdi mdi-text me-1"></i>Users
                                            Lists</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        {!! Form::open(array('route' => 'acl.users.store','method'=>'POST','class'=>'','files'=>true)) !!}

                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Name')}}
                                                    <span class="text-danger">*</span></strong></label>
                                            <div class="col-6">
                                                {!! Form::text('name', $value=old('name'), array('placeholder' => 'Name','class' => 'form-control','required'=>true,'id'=>'name')) !!}

                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Phone')}}
                                                    <sup class="text-danger">*</sup></strong></label>
                                            <div class="col-6">
                                                {!! Form::text('phone', $value=old('phone'), array('placeholder' => 'Phone','class' => 'form-control','required'=>true,'id'=>'phone')) !!}

                                                @if ($errors->has('phone'))
                                                    <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Email')}}</strong></label>
                                            <div class="col-6">
                                                {!! Form::email('email', $value=old('email'), array('placeholder' => 'Email address','class' => 'form-control','required'=>false,'id'=>'email')) !!}

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Password')}}
                                                    <sup class="text-danger">*</sup></strong></label>
                                            <div class="col-6">
                                                {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control','required'=>true)) !!}

                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Confirm Password')}}
                                                    <sup class="text-danger">*</sup></strong></label>
                                            <div class="col-6">
                                                {!! Form::password('confirm_password', array('placeholder' => 'Confirm Password','class' => 'form-control','required'=>true)) !!}

                                                @if ($errors->has('confirm_password'))
                                                    <span class="help-block">
                                                <strong
                                                    class="text-danger">{{ $errors->first('confirm_password') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Profile Photo')}}</strong></label>
                                            <div class="col-6">

                                                <label class="slide_upload" for="file">

                                                    <img id="image_load" src="{{asset('user/09.jpg')}}"
                                                         style="width: 150px; height: 150px;cursor:pointer;">

                                                </label>
                                                <input id="file" style="display:none" name="avatar" type="file"
                                                       onchange="photoLoad(this,this.id)" accept="image/*">
                                                @if ($errors->has('avatar'))
                                                    <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('avatar') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Location')}}</strong></label>
                                            <div class="col-6">
                                                {!! Form::text('location', $value=old('location'), array('placeholder' => 'Location name','class' => 'form-control','readonly'=>false,'id'=>'location_id')) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Assign Role')}}
                                                    (s)</strong></label>
                                            <div class="col-6">
                                                {!! Form::select('roles[]', $roles,[], array('id'=>'select2-1','class' => 'form-control select2','multiple'=>true,'required'=>true)) !!}

                                                @if ($errors->has('roles'))
                                                    <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('roles') }}</strong>
                                        </span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="form-group row mt-2">
                                            @if ($errors->has('permission'))
                                                <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('permission') }}</strong>
                                    </span>
                                                <br>
                                            @endif

                                            <div class="col-md-12">
                                                <h4 class="text-center">{{translate('Allow Permissions')}} (&nbsp;<label
                                                        for="check_all" style="cursor: pointer">
                                                        <input type="checkbox" name="check_all"
                                                               id="check_all">&nbsp;{{translate('Check all Permissions')}}
                                                    </label>)</h4>
                                                <hr>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="row">
                                                    @php
                                                        $chunk_counter = 0;
                                                    @endphp
                                                    @if(isset($modules[0]))
                                                        @foreach($modules as $key => $module)
                                                            @php
                                                                $modulePermissions = collect(Spatie\Permission\Models\Permission::where('module', $module)->get())->chunk(12)
                                                            @endphp
                                                            @foreach($modulePermissions as $chunk)
                                                                @php
                                                                    $chunk_counter++;
                                                                @endphp
                                                                <div class="col-3">
                                                                    <h5 class="">
                                                                        <label
                                                                            for="check_all_module-{{ $chunk_counter  }}"
                                                                            style="cursor: pointer">
                                                                            <input type="checkbox"
                                                                                   class="check-all-module"
                                                                                   data-counter="{{ $chunk_counter  }}"
                                                                                   id="check_all_module-{{ $chunk_counter  }}"
                                                                                   style="transform: scale(1.25, 1.25)">&nbsp;&nbsp;&nbsp;<strong>{{ $module }}</strong>
                                                                        </label>
                                                                    </h5>
                                                                    @foreach($chunk as $permission)
                                                                        <label>
                                                                            <input name="permission[]" type="checkbox"
                                                                                   value="{{ $permission->id }}"
                                                                                   class="name module-permissions-{{ $chunk_counter }} permissions">&nbsp;
                                                                            {{ $permission->name }}
                                                                        </label>
                                                                        <br/>
                                                                    @endforeach
                                                                </div>
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="row">
                                                    @php
                                                        $chunk_counter = 0;
                                                    @endphp
                                                    @if(isset($permissions[0]))
                                                        @foreach($permissions as $key => $chunk)
                                                            @php
                                                                $chunk_counter++;
                                                            @endphp
                                                            <div class="col-3">
                                                                <h5 class="">
                                                                    <label
                                                                        for="check_all_permission-{{ $chunk_counter  }}"
                                                                        style="cursor: pointer">
                                                                        <input type="checkbox"
                                                                               class="check-all-permission"
                                                                               data-counter="{{ $chunk_counter }}"
                                                                               id="check_all_permission-{{ $chunk_counter  }}"
                                                                               style="transform: scale(1.25, 1.25)">&nbsp;&nbsp;&nbsp;<strong>{{translate('Allow
                                                                            Permissions')}}</strong>
                                                                    </label>
                                                                </h5>
                                                                @foreach($chunk as $permission)
                                                                    <label>
                                                                        <input name="permission[]" type="checkbox"
                                                                               value="{{ $permission->id }}"
                                                                               class="name permission-permmissions-{{ $chunk_counter }} permissions">&nbsp;
                                                                        {{ $permission->name }}
                                                                    </label>
                                                                    <br/>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row pt-3">
                                            <div class="col-md-6 offset-md-3">
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="la la-check"></i>&nbsp;{{translate('Save User')}}
                                                </button>
                                                @can('user-list')
                                                    <a href="{{route('acl.users.index')}}" class="btn btn-secondary"><i
                                                            class="la la-times"></i>&nbsp;{{translate('Cancel')}} </a>
                                                @endcan
                                            </div>
                                        </div>

                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script>
        function photoLoad(input, image_load) {
            var target_image = '#' + $('#' + image_load).prev().children().attr('id');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(target_image).attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        $(document).ready(function () {
            $('#check_all').change(function () {
                if ($('#check_all').is(':checked')) {
                    $('.permissions').prop('checked', true);
                    $('.check-all-module').prop('checked', true);
                } else {
                    $('.permissions').prop('checked', false);
                    $('.check-all-module').prop('checked', false);
                }
            });

            $('.check-all-module').change(function (event) {
                if ($(this).is(':checked')) {
                    $('.module-permissions-' + $(this).attr('data-counter')).prop('checked', true);
                } else {
                    $('.module-permissions-' + $(this).attr('data-counter')).prop('checked', false);
                }
            });

            $('.check-all-permission').change(function (event) {
                if ($(this).is(':checked')) {
                    $('.permission-permissions-' + $(this).attr('data-counter')).prop('checked', true);
                } else {
                    $('.permission-permissions-' + $(this).attr('data-counter')).prop('checked', false);
                }
            });

            updateSections();
        });

        function updateSections() {
            var departments = $("#user_department_id :selected").map(function (i, el) {
                return $(el).val();
            }).get();

            $.each($('#user_section_id').find('option'), function (index, val) {
                if ($.inArray($(this).attr('data-department-id'), departments) != -1) {
                    $(this).removeAttr('hidden');
                } else {
                    $(this).attr('hidden', 'hidden');
                }
            });

            $('#user_section_id').select2({
                tags: true,
                templateResult: function (option) {
                    if (option.element && (option.element).hasAttribute('hidden')) {
                        return null;
                    }
                    return option.text;
                }
            });
        }

        (function ($) {
            "use script";
            $('[data-toggle="tooltip"]').tooltip();
            const form = document.getElementById('requisitionForm');
            const tableContainer = document.getElementById('dataTable').querySelector('tbody');

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


            $('#addRequisitionTypeBtn').on('click', function () {
                $('#requisitionTypeModal').modal('show');
                form.setAttribute('data-type', 'post');
            });
        })(jQuery);

        function checkUsers() {
            var associateId = $('#associate_id').val();

            if (associateId != '') {

                $.ajax({
                    url: '{{url('pms/admin/check-user')}}/' + associateId,
                    type: 'get',
                    success: (data) => {

                        if (data.status === 200) {
                            $('#name').val(data.employee.as_name);
                            $('#as_unit_id').val(data.employee.unit.hr_unit_name);
                            $('#location_id').val(data.employee.location.hr_location_name);
                            $('#department_id').val(data.employee.department.hr_department_name);
                            $('#section_id').val(data.employee.section.hr_section_name);
                            $('#designation_id').val(data.employee.designation.hr_designation_name);
                        }

                        if (data.status === 400) {
                            $('#name').val();
                            $('#as_unit_id').val();
                            $('#location_id').val();
                            $('#department_id').val();
                            $('#designation_id').val();
                            $('#phone').val();
                            $('#email').val();
                            $('#roles').select2().val().trigger('change');
                            $('#warehouse_id').select2().val().trigger('change');
                            notify('No user information found with this associate id.', 'error');
                        }
                        if (data.exists_user != null) {
                            $('#phone').val(data.exists_user.phone);
                            $('#email').val(data.exists_user.email);
                            $('#roles').select2().val(data.userRole).trigger('change');
                            $('#warehouse_id').select2().val(data.userWarehouse).trigger('change');
                            notify('An user already exists with this associate id.', 'success');
                        }
                    }
                });

            } else {
                notify('Please enter associate id', 'error');
            }
        }
    </script>
@endsection
