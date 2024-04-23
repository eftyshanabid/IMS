@extends('layouts.master')
@section('css')
    <style type="text/css">
        .col-form-label {
            font-size: 14px;
            font-weight: 600;
        }
        .label {
            font-weight: bold !important;
        }
        .select2-container {
            width: 100% !important;
        }
        .select2-container--default .select2-results__option[aria-disabled=true] {
            color: black !important;
            font-weight: bold !important;
        }
    </style>
@endsection
@section('content')
    @php
        use Illuminate\Support\Facades\Request;
    @endphp
    <div class="content">
        <div class="container-fluid">
            @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),
            'active'=>'Products'],
            'pTitle' => $title])

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-xl-8">
                                </div>
                                <div class="col-xl-4">
                                    <div class="text-xl-end mt-xl-0 mt-2">
                                        <a href="{{route('categories.index')}}" class="btn btn-info mb-2 me-2"
                                           data-toggle="tooltip" title="Category List"> <i class="mdi mdi-text
                                           me-1"></i>{{translate('Category Lists')}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        {!! Form::open(array('route' => 'categories.store','method'=>'POST',
                                        'class'=>'','files'=>true,'id'=>'departmentForm')) !!}

                                        <div class="row">
                                            <div class="col-md-2">
                                                <p class="mb-1 font-weight-bold"><label
                                                        for="code"><strong>{{ __('Code') }} <span class="text-danger">&nbsp;*</span></strong></label> {!! $errors->has('code')? '<span class="text-danger text-capitalize">'. $errors->first('code').'</span>':'' !!}
                                                </p>
                                                <div class="input-group input-group-md mb-3 d-">
                                                    <input type="text" readonly name="code" id="code"
                                                           class="form-control rounded bg-white" aria-label="Large"
                                                           placeholder="{{__('Category Code')}}"
                                                           aria-describedby="inputGroup-sizing-sm" required
                                                           value="{{ $code }}">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <p class="mb-1 font-weight-bold"><label
                                                        for="name"><strong>{{ __('Name') }}<span class="text-danger">&nbsp;*</span></strong></label> {!! $errors->has('name')? '<span class="text-danger text-capitalize">'. $errors->first('name').'</span>':'' !!}
                                                </p>
                                                <div class="input-group input-group-md mb-3 d-">
                                                    <input type="text" name="name" id="name"
                                                           class="form-control rounded" aria-label="Large"
                                                           placeholder="{{__('Category Name')}}"
                                                           aria-describedby="inputGroup-sizing-sm" required
                                                           value="{{ old('name') }}">
                                                </div>
                                            </div>

                                            @if($departments->count() > 0)
                                                <div class="col-md-6">
                                                    <p class="mb-1 font-weight-bold"><label
                                                            for="parent"><strong>{{ __('Departments') }}</strong>:</label> {!! $errors->has('hr_department_id')? '<span class="text-danger text-capitalize">'. $errors->first('department_id').'</span>':'' !!}
                                                    </p>
                                                    <div class="select-search-group input-group input-group-md mb-3 d-">
                                                        <select name="department_id[]" id="department_id"
                                                                class="form-control select2 hr-departments" multiple>
                                                            @foreach($departments as $key => $department)
                                                                <option
                                                                    value="{{ $department->id }}">{{
                                                                    $department->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col-md-12">
                                                <p class="mb-1 font-weight-bold"><label
                                                        for="description"><strong>{{ __('Description') }}<span
                                                                class="text-danger">&nbsp;*</span></strong></label> {!! $errors->has('name')? '<span class="text-danger text-capitalize">'. $errors->first('description').'</span>':'' !!}
                                                </p>
                                                <div class="input-group input-group-md mb-3 d-">
                                                    <textarea name="description" class="form-control"
                                                              id="description">{{ old('description') }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <a class="btn btn-danger rounded pull-right m-1"
                                                   href="{{ url('admin/categories') }}"><i class="mdi
                                                   mdi-redo"></i>&nbsp;{{ __('Close') }}
                                                </a>
                                                <button type="submit" class="btn btn-success rounded pull-right m-1"><i
                                                        class="mdi mdi-plus"></i>&nbsp;{{ __('Save Category')
                                                        }}</button>
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
