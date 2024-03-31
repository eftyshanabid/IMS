@extends('layouts.master')

@section('content')

<div class="content">
    <div class="container-fluid">
        @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),'active'=>'ACL'],
        'pTitle' => 'Menu'])

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-xl-8">
                            </div>
                            <div class="col-xl-4">
                                <div class="text-xl-end mt-xl-0 mt-2">
                                    <a href="{{route('acl.menu.create')}}" class="btn btn-info mb-2 me-2" data-toggle="tooltip" title="Add New Menu"> <i class="mdi mdi-plus me-1"></i>{{translate('Add New Menu')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered center_table" id="my_table">
                                <thead>
                                    <tr class="bg-dark text-white text-center">
                                        <th>{{translate('SL')}}</th>
                                        <th>{{translate('Name')}}</th>
                                        <th>{{translate('URL')}}</th>
                                        <th>{{translate('Menu For')}}</th>
                                        <th>{{translate('Sub Menu')}}</th>
                                        <th>{{translate('Status')}}</th>
                                        <th>{{translate('Created At')}}</th>
                                        <th>{{translate('Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                    @forelse($allData as $data)
                                    <tr>
                                        <td class="text-center">{{$data->serial_num}}</td>
                                        <td><a href="{{route('acl.menu.edit',$data->id)}}"><i class="{{$data->icon_class}}"></i> {{$data->name}}</a></td>
                                        <td><a href="{{url($data->url)}}" target="_blank">{{url($data->url)}}</a></td>

                                        <td><span class="text-success">{{$data->menu_for}}</span></td>

                                        <td><a href="{{route('acl.sub-menu.show',$data->id)}}" class="btn btn-primary btn-sm" style="color: #fff;">Sub Menu ({{$data->subMenu->count('id')}})</a></td>

                                        <td><i class="{{($data->status==App\Models\Menu\Menu::ACTIVE)? 'mdi mdi-check-circle text-success' : 'mdi mdi-alert-circle-check text-danger'}}"></i></td>

                                        <td>{{$data->created_at}}</td>
                                        <td>
                                            {!! Form::open(array('route' => ['acl.menu.destroy',$data->id],'method'=>'DELETE','id'=>"deleteForm$data->id")) !!}

                                            <a href="{{route('acl.menu.edit',$data->id)}}" class="btn btn-success btn-sm"><i class="mdi mdi-pencil-box"></i></a>

                                            <button type="button" class="btn btn-danger btn-sm" onclick='return deleteConfirm("deleteForm{{$data->id}}")'><i class="mdi mdi-trash-can"></i></button>
                                            {!! Form::close() !!}
                                        </td>

                                    </tr>
                                    @empty

                                    <tr>
                                        <td colspan="8" class="text-center"> {{translate('No Menu Data')}} ! </td>
                                    </tr>
                                    @endforelse

                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="la-1x pull-right">
                                        @if(count($allData)>0)
                                        <ul>
                                            {{$allData->links()}}
                                        </ul>
                                        @endif
                                    </div>
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
    function deleteConfirm(id){
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
                $("#"+id).submit();
            }
        })
    }
</script>
@endsection
