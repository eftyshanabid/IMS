@extends('layouts.master')
@section('css')
@endsection
@section('content')

<div class="content">
    <div class="container-fluid">

        @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),'active'=>'ACL'],
        'pTitle' => 'Menu Create'])

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-xl-8">
                            </div>
                            <div class="col-xl-4">
                                <div class="text-xl-end mt-xl-0 mt-2">
                                    <a href="{{route('acl.menu.index')}}" class="btn btn-info mb-2 me-2" data-toggle="tooltip" title="Menu List"> <i class="mdi mdi-text me-1"></i>{{translate('Menu Lists')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    {!! Form::open(array('route' => 'acl.menu.store','method'=>'POST','class'=>'','files'=>true)) !!}

                                    <div class="form-group row  {{ $errors->has('name') ? 'has-error' : '' }}">
                                        <div class="col-1">
                                            {{Form::label('name', ' Name', array('class' => 'control-label text-right'))}}<strong><span class="text-danger">&nbsp;*</span></strong>
                                        </div>

                                        <div class="col-11">
                                            {{Form::text('name','',array('class'=>'form-control','placeholder'=>'Name *','required'))}}
                                        </div>
                                    </div>

                                    <div class="form-group row mt-2 {{ $errors->has('url') ? 'has-error' : '' }}">
                                        <div class="col-1">
                                            {{Form::label('url', 'URL', array('class' => 'control-label text-right'))}}<strong><span class="text-danger">&nbsp;*</span></strong>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group">

                                                {{Form::text('url','',array('class'=>'form-control','placeholder'=>'URL *','required'))}}

                                                @if ($errors->has('url'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('url') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-5">
                                            <div class="input-group">
                                                <span class="input-group-prepend">
                                                    <label class="input-group-text">{{translate('Icon Class')}}:</label>
                                                </span>

                                                {{Form::text('icon_class','',array('class'=>'form-control','placeholder'=>'Ex: fa fa-folder'))}}
                                               {{--  @if ($errors->has('icon_class'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('icon_class') }}</strong>
                                                </span>
                                                @endif
                                                <label class="slide_upload profile-image ml-2" for="file">
                                                    <img id="image_load" src="{{asset('images/default/default.png')}}" style="width: 100px;height: auto; cursor:pointer;border-radius:50%;">
                                                </label> --}}
                                            </div>
                                        </div>


                                        {{-- <div class="form-group row mt-2">
                                            <div class="col-8">
                                                <input id="file" style="display:none" name="icon" type="file" onchange="photoLoad(this,this.id)" accept="image/*">
                                                @if ($errors->has('icon'))
                                                <span class="help-block text-danger">
                                                    <strong>The icon image dimensions(Y, X) should not be less then 120 and grater then 240</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div> --}}
                                    </div>

                                    <div class="form-group row mt-2">
                                        <div class="col-1">
                                            {{Form::label('serial_num', 'Others', array('class' => 'control-label text-right'))}}<strong><span class="text-danger">&nbsp;*</span></strong>
                                        </div>
                                        <div class="col-2">
                                            <?php $max=$max_serial+1; ?>
                                            {{Form::number('serial_num',"$max",['class'=>'form-control','placeholder'=>'Serial Number','max'=>"$max",'min'=>'0','required'=>true])}}
                                            <small> {{translate('Serial')}} </small>
                                        </div>

                                        <div class="col-3">
                                            {{Form::select('menu_for', $menuFor,'', ['class' => 'form-control'])}}
                                            <small> {{translate('Menu For')}} </small>
                                        </div>

                                        <div class="col-3">
                                            {{Form::select('status', $status, '', ['class' => 'form-control'])}}
                                            <small> {{translate('Status')}} </small>
                                        </div>

                                        <div class="col-3">
                                            {{Form::select('open_new_tab', $openTab,'', ['class' => 'form-control'])}}
                                            <small> {{translate('Open New Tab')}}? </small>
                                        </div>

                                    </div>

                                    <div class="form-group row mt-2">
                                        <div class="col-1">
                                            <label for="example-text-input" class="col-form-label text-right">{{translate('Permission')}}</label>
                                        </div>
                                        <div class="col-11">
                                            {!! Form::select('slug[]', $permissions,[], array('id'=>'slug','class' => 'form-control select2','multiple'=>true,'required'=>false)) !!}

                                            @if ($errors->has('slug'))
                                            <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('slug') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12">
                                        <button type="submit" class="btn btn-success pull-right mr-2">{{translate('Submit')}}</button>
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
    function photoLoad(input,image_load) {
        var target_image='#'+$('#'+image_load).prev().children().attr('id');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(target_image).attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
