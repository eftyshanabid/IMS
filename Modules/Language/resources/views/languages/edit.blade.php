@extends('layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">

            @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),'active'=>'Language'],
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
                                        <a href="{{route('languages.index')}}" class="btn btn-info mb-2 me-2"
                                           data-toggle="tooltip" title="Languages"> <i class="mdi mdi-text
                                           me-1"></i>{{translate('Languages')}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                        {!! Form::model($language, [
                                            'route' => ['languages.update', $language->id],
                                            'method' => 'PUT',
                                            'class' => 'form-horizontal',
                                            'files' => false,
                                        ]) !!}

                                        @include('language::languages._form')

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

