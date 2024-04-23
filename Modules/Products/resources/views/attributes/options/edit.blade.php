@extends('layouts.master')

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
                                        <a href="{{route('attribute-options.index')}}" class="btn btn-info mb-2 me-2"
                                           data-toggle="tooltip" title="Attribute Options List"> <i class="mdi mdi-text
                                           me-1"></i>{{translate('Attribute Options Lists')}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        {!! Form::model($attributeOption, [
                                            'route' => ['attribute-options.update', $attributeOption->id],
                                            'method' => 'PUT',
                                            'class' => 'form-horizontal',
                                            'files' => false,
                                            ]) !!}

                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="company_id"><strong>{{ __('Attributes') }}:<span
                                                            class="text-danger">&nbsp;*</span></strong></label>
                                                <div class="input-group input-group-md mb-3 d-">
                                                    <select name="attribute_id" id="attribute_id"
                                                            class="form-control rounded">
                                                        @if(isset($attributes[0]))
                                                            @foreach($attributes as $key => $attribute)
                                                                <option
                                                                    value="{{ $attribute->id }}" {{ $attributeOption->attribute_id == $attribute->id ? 'selected' : '' }}>
                                                                    [{{ $attribute->code}}
                                                                    ] {{ $attribute->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="name"><strong>{{ __('Attribute Option Name') }}:<span
                                                            class="text-danger">&nbsp;*</span></strong></label>
                                                <div class="input-group input-group-md mb-3 d-">
                                                    <input type="text" name="name" id="name"
                                                           value="{{ old('name', $attributeOption->name) }}"
                                                           class="form-control rounded">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label
                                                    for="description"><strong>{{ __('Attribute Option Description') }}
                                                        :</strong></label>
                                                <div class="input-group input-group-md mb-3 d-">
                                                    <input type="text" name="description" id="description"
                                                           value="{{ old('description', $attributeOption->description) }}"
                                                           class="form-control rounded">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-right">
                                                <a class="btn btn-dark btn-md"
                                                   href="{{ url('admin/attribute-options') }}"><i
                                                        class="la la-times"></i>&nbsp;Cancel</a>
                                                <button type="submit" class="btn btn-success btn-md"><i
                                                        class="la la-save"></i>&nbsp;Update Attribute Option
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
