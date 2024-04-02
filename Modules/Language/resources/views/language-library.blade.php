@extends('layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),'active'=>'Language'],
            'pTitle' => 'Language Library'])
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <form action="{{ route('language-library.store') }}" method="post" accept-charset="utf-8">
                                @csrf
                                    <div class="col-md-12">
                                        <label for="slug"><strong>Slug <span class="text-danger">*</span></strong></label>
                                        <select name="slug" id="slug" class="form-control select2bs4-tags"
                                                onchange="window.open('{{ url('admin/language-library')  }}?slug='+$
                                                ('#slug').val(), '_parent')">
                                            <option value="" disabled selected>{{translate('Choose a Slug')}}</option>
                                            @if(isset($slugs[0]))
                                            @foreach($slugs as $slug)
                                            <option value="{{ $slug->slug }}" {{ request()->get('slug') == $slug->slug ? 'selected' : '' }}>{{ $slug->slug }}</option>
                                            @endforeach
                                            @endif

                                            @if(!empty(request()->get('slug')) && $slugs->where('slug', request()->get('slug'))->count() == 0)
                                            <option value="{{ request()->get('slug') }}" selected>{{ request()->get('slug') }}</option>
                                            @endif
                                        </select>
                                    </div>

                                    @if(isset($languages[0]))
                                    <div class="col-md-12 mt-3">
                                        <div class="row">
                                            @foreach($languages as $language)
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="language-{{ $language->id }}"><strong>{{ translate($language->name) }} <span class="text-danger">*</span></strong></label>
                                                    <input type="text" name="languages[{{ $language->id }}]" value="{{ $libraries->where('language_id', $language->id)->count() > 0 ? $libraries->where('language_id', $language->id)->first()->translation : '' }}" class="form-control">
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif

                                    <button class="btn btn-success btn-md mt-3"><i class="fa fa-check"></i>&nbsp;
                                        {{translate('Save Changes')}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
