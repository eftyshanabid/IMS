@extends('layouts.master')
@section('css')
@endsection
@section('content')

    <div class="content">
        <div class="container-fluid">

            @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),'active'=>'Website'],
            'pTitle' => $title])

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-xl-8">
                                </div>
                                <div class="col-xl-4">

                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        {!! Form::open(array('route' => 'wallet.settings.store','method'=>'POST','class'=>'','files'=>true)) !!}
                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Environment')}}
                                                    <span
                                                        class="text-danger">*</span></strong></label>
                                            <div class="col-6">
                                                {!! Form::text('environment', isset($model)?$model->environment:$value=old('environment'), array('placeholder' => 'environment','class' => 'form-control','required'=>true,'id'=>'environment')) !!}

                                                @if ($errors->has('environment'))
                                                    <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('environment') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Access Token')}}
                                                    <span
                                                        class="text-danger">*</span></strong></label>
                                            <div class="col-6">
                                                {!! Form::text('access_token', isset($model)?$model->access_token:$value=old('access_token'), array('placeholder' => 'access_token','class' => 'form-control','required'=>true,'id'=>'access_token')) !!}

                                                @if ($errors->has('access_token'))
                                                    <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('access_token') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Application ID')}}
                                                    <span
                                                        class="text-danger">*</span></strong></label>
                                            <div class="col-6">
                                                {!! Form::text('application_id', isset($model)?$model->application_id:$value=old('application_id'), array('placeholder' => 'application_id','class' => 'form-control','required'=>true,'id'=>'application_id')) !!}

                                                @if ($errors->has('application_id'))
                                                    <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('application_id') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Location ID')}}
                                                    <span
                                                        class="text-danger">*</span></strong></label>
                                            <div class="col-6">
                                                {!! Form::text('location_id', isset($model)?$model->location_id:$value=old('location_id'), array('placeholder' => 'location_id','class' => 'form-control','required'=>true,'id'=>'location_id')) !!}

                                                @if ($errors->has('location_id'))
                                                    <span class="help-block">
                                                <strong
                                                    class="text-danger">{{ $errors->first('location_id') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
{{--                                        <div class="form-group row mt-2">--}}
{{--                                            <label for="example-text-input"--}}
{{--                                                   class="col-3 col-form-label text-right"><strong>{{translate('Redirect URL')}}--}}
{{--                                                    <span--}}
{{--                                                        class="text-danger">*</span></strong></label>--}}
{{--                                            <div class="col-6">--}}
{{--                                                {!! Form::text('redirect_url', isset($model)?$model->redirect_url:$value=old('redirect_url'), array('placeholder' => 'redirect_url','class' => 'form-control','required'=>true,'id'=>'redirect_url')) !!}--}}

{{--                                                @if ($errors->has('redirect_url'))--}}
{{--                                                    <span class="help-block">--}}
{{--                                                <strong--}}
{{--                                                    class="text-danger">{{ $errors->first('redirect_url') }}</strong>--}}
{{--                                            </span>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Merchant Support Email')}}
                                                    <span
                                                        class="text-danger">*</span></strong></label>
                                            <div class="col-6">
                                                {!! Form::text('merchant_support_email', isset($model)?$model->merchant_support_email:$value=old('merchant_support_email'), array('placeholder' => 'merchant_support_email','class' => 'form-control','required'=>true,'id'=>'merchant_support_email')) !!}

                                                @if ($errors->has('merchant_support_email'))
                                                    <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('merchant_support_email') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row pt-3">
                                    <div class="col-md-6 offset-md-3">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="la la-check"></i>&nbsp;{{translate('Save Settings')}}
                                        </button>
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

@endsection
