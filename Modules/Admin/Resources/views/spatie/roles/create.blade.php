@extends('layouts.master')
@section('css')
@endsection
@section('content')

    <div class="content">
        <div class="container-fluid">

            @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),'active'=>'ACL'],
            'pTitle' => 'Roles Create'])

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-xl-8">
                                </div>
                                <div class="col-xl-4">
                                    <div class="text-xl-end mt-xl-0 mt-2">
                                        <a href="{{route('acl.roles.index')}}" class="btn btn-info mb-2 me-2"
                                           data-toggle="tooltip" title="Role List"> <i
                                                class="mdi mdi-text me-1"></i>{{translate('Role Lists')}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        {!! Form::open(array('route' => 'acl.roles.store','method'=>'POST','class'=>'kt-form kt-form--label-right')) !!}

                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="example-text-input"
                                                       class="col-form-label text-right"><strong>{{translate('Role Name')}}
                                                        <span class="text-danger">&nbsp;*</span></strong></label>
                                                {!! Form::text('name', $value=old('name'), array('placeholder' => 'Role Name Here','class' => 'form-control','required'=>true)) !!}

                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                            <div class="col-md-9">
                                                <label for="example-text-input"
                                                       class="col-form-label text-right">{{translate('Word Restrictions')}}</label>
                                                {!! Form::text('word_restrictions', $value=old('word_restrictions'), array('placeholder' => 'Write Words here (Separated by Comma)','class' => 'form-control','required'=>false)) !!}

                                                @if ($errors->has('word_restrictions'))
                                                    <span class="help-block">
                                                <strong
                                                    class="text-danger">{{ $errors->first('word_restrictions') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row">
                                            @if ($errors->has('permission'))
                                                <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('permission') }}</strong>
                                        </span>
                                                <br>
                                            @endif

                                            <div class="col-md-12 mb-2">
                                                <label for="check_all" style="cursor: pointer">
                                                    <input type="checkbox" name="check_all" id="check_all"
                                                           style="transform: scale(1.5, 1.5)">&nbsp;&nbsp;&nbsp;<strong>{{translate('Check all Permissions')}}</strong>
                                                </label>
                                                <hr class="mt-0 pt-0">
                                            </div>

                                            <div class="col-md-12">
                                                <div class="row">
                                                    @php
                                                        $chunk_counter = 0;
                                                    @endphp
                                                    @if(isset($modules[0]))
                                                        @foreach($modules as $key => $module)
                                                            @php
                                                                $modulePermissions = collect(Spatie\Permission\Models\Permission::where('module', $module)->get())->chunk(10)
                                                            @endphp
                                                            @if(isset($modulePermissions[0]))
                                                                @foreach($modulePermissions as $chunk)
                                                                    @php
                                                                        $chunk_counter++;
                                                                    @endphp
                                                                    <div class="col-3 mb-3">
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
                                                                                <input name="permission[]"
                                                                                       type="checkbox"
                                                                                       value="{{ $permission->name }}"
                                                                                       class="name module-permissions-{{ $chunk_counter }} permissions">&nbsp;
                                                                                {{ $permission->name }}
                                                                            </label>
                                                                            <br/>
                                                                        @endforeach
                                                                    </div>
                                                                @endforeach
                                                            @endif
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
                                                        @foreach($permissions as $chunk)
                                                            @php
                                                                $chunk_counter++;
                                                            @endphp
                                                            <div class="col-3 mb-3">
                                                                <h5 class="">
                                                                    <label
                                                                        for="check_all_permission-{{ $chunk_counter  }}"
                                                                        style="cursor: pointer">
                                                                        <input type="checkbox"
                                                                               class="check-all-permission"
                                                                               data-counter="{{ $chunk_counter }}"
                                                                               id="check_all_permission-{{ $chunk_counter  }}"
                                                                               style="transform: scale(1.25, 1.25)">&nbsp;&nbsp;&nbsp;<strong>Allow
                                                                            Permissions</strong>
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

                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit"
                                                        class="btn btn-primary pull-right">{{translate('Submit')}}</button>
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
        });

    </script>
@endsection
