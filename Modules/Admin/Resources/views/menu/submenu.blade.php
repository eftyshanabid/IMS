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
                                        <a href="{{route('acl.menu.index')}}" class="btn btn-info mb-2 me-2"
                                           data-toggle="tooltip" title="Menu List"> <i
                                                class="mdi mdi-text me-1"></i>{{translate('Main Menu Lists')}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                        {!! Form::open(array('route' => 'acl.sub-menu.store','method'=>'POST','class'=>'kt-form kt-form--label-right','files'=>true)) !!}

                                        <div class="form-group row mt-2  {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <div class="col-md-1">
                                                {{Form::label('name', 'Name', array('class' => ' control-label text-right'))}}
                                                <strong><span class="text-danger">&nbsp;*</span></strong>
                                            </div>
                                            <div class="col-md-11">
                                                {{Form::text('name','',array('class'=>'form-control','placeholder'=>'Sub Menu Name *','required'))}}

                                                <input type="hidden" name="menu_id" value="{{$menu->id}}">
                                            </div>
                                        </div>

                                        <div class="form-group row mt-2 {{ $errors->has('url') ? 'has-error' : '' }}">

                                            <div class="col-md-1">
                                                {{Form::label('url', 'URL', array('class' => ' control-label text-right'))}}
                                                <strong><span class="text-danger">&nbsp;*</span></strong>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="input-group">

                                                    {{Form::text('url','',array('class'=>'form-control','placeholder'=>'URL *','required'))}}

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

                                                    {{Form::text('icon_class','',array('class'=>'form-control','placeholder'=>'Ex: fa fa-folder'))}}
                                                    @if ($errors->has('icon_class'))
                                                        <span class="help-block">
                                                <strong>{{ $errors->first('icon_class') }}</strong>
                                            </span>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- <div class="form-group ">
                                                <div class="col-md-2">
                                                    <label class="slide_upload profile-image" for="file">
                                                        <img id="image_load" src="{{asset('images/default/default.png')}}" style="width: 100px;height: auto; cursor:pointer;">
                                                    </label>

                                                    <input id="file" style="display:none" name="icon" type="file" onchange="photoLoad(this,this.id)" accept="image/*">
                                                    @if ($errors->has('icon'))
                                                    <span class="help-block text-danger">
                                                        <strong>The icon image dimensions(Y, X) should not be less then 120 and grater then 240</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>--}}
                                        </div>
                                        <div class="form-group row mt-2">

                                            <div class="col-md-1">
                                                {{Form::label('serial_num', 'Others', array('class' => 'control-label text-right'))}}
                                                <strong><span class="text-danger">&nbsp;*</span></strong>
                                            </div>
                                            <div class="col-md-2">
                                                <?php $max = $max_serial + 1; ?>
                                                {{Form::number('serial_num',"$max",['class'=>'form-control','placeholder'=>'Serial Number','max'=>"$max",'min'=>'0','required'=>true])}}
                                                <small> {{translate('Serial')}} </small>
                                            </div>

                                            <div class="col-md-3">
                                                {{Form::select('menu_for', $menuFor,'', ['class' => 'form-control'])}}
                                                <small> {{translate('Menu For')}} </small>
                                            </div>

                                            <div class="col-md-3">
                                                {{Form::select('status', $status,'', ['class' => 'form-control'])}}
                                                <small> {{translate('Status')}} </small>
                                            </div>

                                            <div class="col-md-3">
                                                {{Form::select('open_new_tab', $openTab,'', ['class' => 'form-control'])}}
                                                <small> {{translate('Open New Tab')}}? </small>
                                            </div>

                                        </div><!-- end row -->

                                        <div class="form-group row mt-2">
                                            <div class="col-1">
                                                <label for="example-text-input"
                                                       class="col-form-label text-right">{{translate('Permission')}}</label>
                                            </div>
                                            <div class="col-11">
                                                {!! Form::select('slug[]', $permissions,[], array('class' => 'form-control select2','multiple'=>true,'required'=>false)) !!}

                                                @if ($errors->has('slug'))
                                                    <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('slug') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mt-2">

                                            <div class="col-12">
                                                <button type="submit"
                                                        class="btn btn-success pull-right">{{translate('Submit')}}</button>
                                            </div>
                                        </div>

                                        {!! Form::close() !!}

                                        <hr>
                                        <div
                                            class="row justify-content-md-center justify-content-lg-center table-responsive">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <table
                                                    class="table table-striped table-hover table-bordered center_table"
                                                    id="my_table">
                                                    <thead>
                                                    <tr class="bg-dark text-white text-center">
                                                        <th>{{translate('SL')}}</th>
                                                        <th>{{translate('Menu')}}</th>
                                                        <th>{{translate('Sub Menu')}}</th>
                                                        <th>{{translate('URL')}}</th>
                                                        <th>{{translate('Sub Menu For')}}</th>
                                                        <th>{{translate('Status')}}</th>
                                                        <th>{{translate('Created At')}}</th>
                                                        <th>{{translate('Action')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $i = 1; ?>
                                                    @forelse($allData as $data)
                                                        <tr>
                                                            <td class="text-center">{{$data->serial_num}}</td>
                                                            <td>{{$menu->name}}</td>
                                                            <td><a href="#" data-toggle="modal"
                                                                   data-target="#subMenuModal{{$data->id}}"><i
                                                                        class="{{$data->icon_class}}"></i> {{$data->name}}
                                                                </a></td>
                                                            <td><a href="{{url($data->url)}}"
                                                                   target="_blank">{{url($data->url)}}</a></td>

                                                            <td><span class="text-success">{{$data->menu_for}}</span>
                                                            </td>


                                                            <td>
                                                                <i class="{{($data->status==App\Models\Menu\SubMenu::ACTIVE)? 'mdi mdi-check-circle text-success' : 'mdi mdi-alert-circle-check text-danger'}}"></i>
                                                            </td>

                                                            <td>{{$data->created_at}}</td>
                                                            <td>
                                                                {!! Form::open(array('route' => ['acl.sub-menu.destroy',$data->id],'method'=>'DELETE','id'=>"deleteForm$data->id")) !!}
                                                                <a href="{{route('acl.sub-menu.edit',$data->id)}}"
                                                                   class="btn btn-success btn-sm"><i
                                                                        class="mdi mdi-pencil-box"></i> </a>
                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                        onclick='return deleteConfirm("deleteForm{{$data->id}}")'>
                                                                    <i class="mdi mdi-trash-can"></i></button>
                                                                {!! Form::close() !!}
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="8"
                                                                class="text-center"> {{translate('No Menu Data')}} !
                                                            </td>
                                                        </tr>
                                                    @endforelse

                                                    </tbody>
                                                </table>

                                            </div>
                                        </div> <!--end Table view -->

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
