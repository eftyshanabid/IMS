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
                                        {!! Form::open(array('route' => 'mail.settings.store','method'=>'POST','class'=>'','files'=>true)) !!}

                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Mail Mailer')}}
                                                    <span
                                                        class="text-danger">*</span></strong></label>
                                            <div class="col-6">
                                                {!! Form::text('mail_mailer', isset($model)?$model->mail_mailer:$value=old('mail_mailer'), array('placeholder' => 'mail_mailer','class' => 'form-control','required'=>true,'id'=>'mail_mailer')) !!}

                                                @if ($errors->has('mail_mailer'))
                                                    <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('mail_mailer') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Mail Host')}}
                                                    <span
                                                        class="text-danger">*</span></strong></label>
                                            <div class="col-6">
                                                {!! Form::text('mail_host', isset($model)?$model->mail_host:$value=old('mail_host'), array('placeholder' => 'mail_host','class' => 'form-control','required'=>true,'id'=>'mail_host')) !!}

                                                @if ($errors->has('mail_host'))
                                                    <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('mail_host') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Mail Port')}}
                                                    <span
                                                        class="text-danger">*</span></strong></label>
                                            <div class="col-6">
                                                {!! Form::text('mail_port', isset($model)?$model->mail_port:$value=old('mail_port'), array('placeholder' => 'mail_port','class' => 'form-control','required'=>true,'id'=>'mail_port')) !!}

                                                @if ($errors->has('mail_port'))
                                                    <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('mail_port') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Mail User Name')}}
                                                    <span
                                                        class="text-danger">*</span></strong></label>
                                            <div class="col-6">
                                                {!! Form::text('mail_user_name', isset($model)?$model->mail_user_name:$value=old('mail_user_name'), array('placeholder' => 'mail_user_name','class' => 'form-control','required'=>true,'id'=>'mail_user_name')) !!}

                                                @if ($errors->has('mail_user_name'))
                                                    <span class="help-block">
                                                <strong
                                                    class="text-danger">{{ $errors->first('mail_user_name') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('User Password')}}
                                                    <span
                                                        class="text-danger">*</span></strong></label>
                                            <div class="col-6">
                                                {!! Form::text('mail_user_password', isset($model)?$model->mail_user_password:$value=old('mail_user_password'), array('placeholder' => 'mail_user_password','class' => 'form-control','required'=>true,'id'=>'mail_user_password')) !!}

                                                @if ($errors->has('mail_user_password'))
                                                    <span class="help-block">
                                                <strong
                                                    class="text-danger">{{ $errors->first('mail_user_password') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Encryption')}}
                                                    <span
                                                        class="text-danger">*</span></strong></label>
                                            <div class="col-6">
                                                {!! Form::text('mail_encryption', isset($model)?$model->mail_encryption:$value=old('mail_encryption'), array('placeholder' => 'mail_encryption','class' => 'form-control','required'=>true,'id'=>'mail_encryption')) !!}

                                                @if ($errors->has('mail_encryption'))
                                                    <span class="help-block">
                                                <strong
                                                    class="text-danger">{{ $errors->first('mail_encryption') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('From Address')}}
                                                    <span
                                                        class="text-danger">*</span></strong></label>
                                            <div class="col-6">
                                                {!! Form::text('mail_from_address', isset($model)?$model->mail_from_address:$value=old('mail_from_address'), array('placeholder' => 'mail_from_address','class' => 'form-control','required'=>true,'id'=>'mail_from_address')) !!}

                                                @if ($errors->has('mail_from_address'))
                                                    <span class="help-block">
                                                <strong
                                                    class="text-danger">{{ $errors->first('mail_from_address') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Mail Name')}}
                                                    <span
                                                        class="text-danger">*</span></strong></label>
                                            <div class="col-6">
                                                {!! Form::text('mail_name', isset($model)?$model->mail_name:$value=old('mail_name'), array('placeholder' => 'mail_name','class' => 'form-control','required'=>true,'id'=>'mail_name')) !!}

                                                @if ($errors->has('mail_name'))
                                                    <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('mail_name') }}</strong>
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
