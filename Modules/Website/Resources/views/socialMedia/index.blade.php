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
                                        {!! Form::open(array('route' => 'social.settings.store','method'=>'POST','class'=>'','files'=>true)) !!}

                                        {{-- <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Twitter')}}
                                                    <span
                                                        class="text-danger">*</span></strong></label>
                                            <div class="col-6">
                                                {!! Form::text('twitter', isset($model)?$model->twitter:$value=old('twitter'), array('placeholder' => 'twitter','class' => 'form-control','required'=>true,'id'=>'twitter')) !!}

                                                @if ($errors->has('twitter'))
                                                    <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('twitter') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div> --}}

                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Facebook')}}
                                                    <span
                                                        class="text-danger">*</span></strong></label>
                                            <div class="col-6">
                                                {!! Form::text('facebook', isset($model)?$model->facebook:$value=old('facebook'), array('placeholder' => 'twitter','class' => 'form-control','required'=>true,'id'=>'facebook')) !!}

                                                @if ($errors->has('facebook'))
                                                    <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('facebook') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Linkedin')}}
                                                    <span
                                                        class="text-danger">*</span></strong></label>
                                            <div class="col-6">
                                                {!! Form::text('telegram', isset($model)?$model->telegram:$value=old('telegram'), array('placeholder' => 'linkedin','class' => 'form-control','required'=>true,'id'=>'telegram')) !!}

                                                @if ($errors->has('telegram'))
                                                    <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('telegram') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Instagram')}}
                                                    <span
                                                        class="text-danger">*</span></strong></label>
                                            <div class="col-6">
                                                {!! Form::text('discord', isset($model)?$model->discord:$value=old('discord'), array('placeholder' => 'instagram','class' => 'form-control','required'=>true,'id'=>'discord')) !!}

                                                @if ($errors->has('discord'))
                                                    <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('discord') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Youtube')}}
                                                    <span
                                                        class="text-danger">*</span></strong></label>
                                            <div class="col-6">
                                                {!! Form::text('youtube', isset($model)?$model->youtube:$value=old('youtube'), array('placeholder' => 'youtube','class' => 'form-control','required'=>true,'id'=>'youtube')) !!}

                                                @if ($errors->has('youtube'))
                                                    <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('youtube') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Tiktok')}}
                                                    <span
                                                        class="text-danger">*</span></strong></label>
                                            <div class="col-6">
                                                {!! Form::text('tiktok', isset($model)?$model->tiktok:$value=old('tiktok'), array('placeholder' => 'tiktok','class' => 'form-control','required'=>true,'id'=>'tiktok')) !!}

                                                @if ($errors->has('tiktok'))
                                                    <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('tiktok') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        {{-- <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Vimeo')}}
                                                    <span
                                                        class="text-danger">*</span></strong></label>
                                            <div class="col-6">
                                                {!! Form::text('vimeo', isset($model)?$model->vimeo:$value=old('vimeo'), array('placeholder' => 'vimeo','class' => 'form-control','required'=>true,'id'=>'youtube')) !!}

                                                @if ($errors->has('vimeo'))
                                                    <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('vimeo') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div> --}}

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

@endsection

@section('javascript')

@endsection
