@extends('layouts.master')
@section('css')
@endsection
@section('content')

    <div class="content">
        <div class="container-fluid">
            @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),'active'=>'ACL'],
            'pTitle' => 'Menu Edit'])
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-xl-8">
                                </div>
                                <div class="col-xl-4">
                                    <div class="text-xl-end mt-xl-0 mt-2">
                                        <a href="{{route('acl.sub-menu.show',$data->menu_id)}}"
                                           class="btn btn-info mb-2 me-2" data-toggle="tooltip" title="Submenu List"> <i
                                                class="mdi mdi-text me-1"></i>{{translate('Submenu List')}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        {!! Form::open(array('route' => ['acl.sub-menu.update',$data->id],'method'=>'PUT','class'=>'kt-form kt-form--label-right','files'=>true)) !!}

                                        <div class="form-group row mt-2 {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <div class="col-md-1">
                                                {{Form::label('name', ' Sub Menu', array('class' => ' control-label text-right'))}}
                                                <strong><span class="text-danger">&nbsp;*</span></strong>
                                            </div>
                                            <div class="col-md-11">
                                                {{Form::text('name',$data->name,array('class'=>'form-control','placeholder'=>'Sub Menu Name *','required'))}}

                                                <input type="hidden" name="menu_id" value="{{$menu->id}}">
                                            </div>
                                        </div>

                                        <div class="form-group row mt-2 {{ $errors->has('url') ? 'has-error' : '' }}">

                                            <div class="col-md-1">
                                                {{Form::label('url', 'URL', array('class' => 'control-label text-right'))}}
                                                <strong><span class="text-danger">&nbsp;*</span></strong>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="input-group">

                                                    {{Form::text('url',$data->url,array('class'=>'form-control','placeholder'=>'URL *','required'))}}

                                                    @if ($errors->has('url'))
                                                        <span class="help-block">
                                                <strong>{{ $errors->first('url') }}</strong>
                                            </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-lg-4">
                                                <div class="input-group">
                                            <span class="input-group-prepend">
                                                <label class="input-group-text">{{translate('Icon Class')}}:</label>
                                            </span>

                                                    {{Form::text('icon_class',$data->icon_class,array('class'=>'form-control','placeholder'=>'Ex: fa fa-folder'))}}
                                                    @if ($errors->has('icon_class'))
                                                        <span class="help-block">
                                                <strong>{{ $errors->first('icon_class') }}</strong>
                                            </span>
                                                    @endif
                                                </div>
                                            </div>

                                            {{--<div class="form-group ">
                                                <div class="col-md-2">
                                                    <label class="slide_upload profile-image" for="file">
                                                        @if(!empty($data->icon))

                                                        <img id="image_load" src="{{asset($data->icon)}}" style="width: 50px;height:auto; cursor:pointer;border-radius:50%;">

                                                        @else
                                                        <img id="image_load" src="{{asset('images/default/default.png')}}" style="width: 100px;height: auto; cursor:pointer;border-radius:50%;">
                                                        @endif
                                                    </label>

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

                                            <div class="col-md-1">
                                                {{Form::label('serial_num', 'Others', array('class' => 'control-label text-right'))}}
                                            </div>
                                            <div class="col-md-2">
                                                <?php $max = $max_serial + 1; ?>
                                                {{Form::number('serial_num',$data->serial_num,['class'=>'form-control','placeholder'=>'Serial Number','max'=>"$max",'min'=>'0','required'=>true])}}
                                                <small> Serial </small>
                                            </div>

                                            <div class="col-md-3">
                                                {{Form::select('menu_for', $menuFor,$data->menu_for, ['class' => 'form-control'])}}
                                                <small> {{translate('Menu For')}} </small>
                                            </div>

                                            <div class="col-md-3">
                                                {{Form::select('status', $status,$data->status, ['class' => 'form-control'])}}
                                                <small> {{translate('Status')}} </small>
                                            </div>

                                            <div class="col-md-3">
                                                {{Form::select('open_new_tab', $openTab,$data->open_new_tab, ['class' => 'form-control'])}}
                                                <small> {{translate('Open New Tab')}}? </small>
                                            </div>

                                        </div>

                                        <div class="form-group row mt-2">
                                            <div class="col-1">
                                                <label for="example-text-input"
                                                       class="col-form-label text-right">{{translate('Permission')}}</label>
                                            </div>
                                            <div class="col-11">
                                                {!! Form::select('slug[]', $permissions,json_decode($data->slug), array('class' => 'form-control select2','multiple'=>true,'required'=>false)) !!}

                                                @if ($errors->has('slug'))
                                                    <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('slug') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-2">
                                            </div>
                                            <div class="col-10">
                                                <button type="submit"
                                                        class="btn btn-success pull-right">{{translate('Submit')}}</button>
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
