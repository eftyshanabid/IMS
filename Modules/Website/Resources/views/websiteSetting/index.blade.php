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
                                        {!! Form::open(array('route' => 'website.settings.store','method'=>'POST','class'=>'','files'=>true, 'novalidate' => true)) !!}

                                        @include('lang-input', [
                                            'text' => 'Name',
                                            'name' => 'name',
                                            'input' => $website->name,
                                            'required' => true,
                                            'inline' => true,
                                        ])

                                        @include('lang-input', [
                                            'text' => 'Slogan',
                                            'name' => 'slogan',
                                            'input' => $website->slogan,
                                            'required' => true,
                                            'inline' => true,
                                        ])

                                        <div class="form-group row mt-2">
                                            <label for="official_email"
                                                   class="col-3 col-form-label
                                                   text-right"><strong>{{translate('Official Email')}}</strong></label>
                                            <div class="col-6">
                                                {!! Form::text('official_email', isset($website)
                                                ?$website->official_email:$value=old('official_email'), array
                                                ('placeholder' => 'Email','class' => 'form-control',
                                                'id'=>'official_email')) !!}

                                                @if ($errors->has('official_email'))
                                                    <span class="help-block">
                                                <strong
                                                    class="text-danger">{{ $errors->first('official_email') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mt-2">
                                            <label for="membership_email"
                                                   class="col-3 col-form-label
                                                   text-right"><strong>{{translate('Membership Email')}}</strong></label>
                                            <div class="col-6">
                                                {!! Form::text('membership_email', isset($website)
                                                ?$website->membership_email:$value=old('membership_email'), array
                                                ('placeholder' => 'Email','class' => 'form-control',
                                                'id'=>'membership_email')) !!}

                                                @if ($errors->has('membership_email'))
                                                    <span class="help-block">
                                                <strong
                                                    class="text-danger">{{ $errors->first('membership_email') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mt-2">
                                            <label for="agreement_email"
                                                   class="col-3 col-form-label
                                                   text-right"><strong>{{translate('Agreement Email')}}</strong></label>
                                            <div class="col-6">
                                                {!! Form::text('agreement_email', isset($website)
                                                ?$website->agreement_email:$value=old('agreement_email'), array
                                                ('placeholder' => 'Email','class' => 'form-control',
                                                'id'=>'agreement_email')) !!}

                                                @if ($errors->has('agreement_email'))
                                                    <span class="help-block">
                                                <strong
                                                    class="text-danger">{{ $errors->first('agreement_email') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mt-2">
                                            <label for="official_phone"
                                                   class="col-3 col-form-label
                                                   text-right"><strong>{{translate('Official Phone Number')}}</strong></label>
                                            <div class="col-6">
                                                {!! Form::text('official_phone', isset($website)
                                                ?$website->official_phone:$value=old('official_phone'), array
                                                ('placeholder' => 'Phone','class' => 'form-control',
                                                'id'=>'official_phone')) !!}

                                                @if ($errors->has('official_phone'))
                                                    <span class="help-block">
                                                <strong
                                                    class="text-danger">{{ $errors->first('official_phone') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        @include('lang-input', [
                                            'text' => 'Official Address',
                                            'name' => 'official_address',
                                            'input' => $website->official_address,
                                            'required' => true,
                                            'inline' => true,
                                        ])

                                        {{--                                        @php--}}
                                        {{--                                            $business_structures = json_decode($website->business_structures, true);--}}
                                        {{--                                        @endphp--}}
                                        {{--                                        <div class="form-group row mt-2">--}}
                                        {{--                                            <label for="example-text-input"--}}
                                        {{--                                                   class="col-3 col-form-label text-right"><strong>{{translate('Business Structures')}}</strong></label>--}}
                                        {{--                                            <div class="col-6">--}}
                                        {{--                                                <select name="business_structures[]" id="business_structures" multiple class="form-control select2bs4-tags">--}}
                                        {{--                                                    @if(isset($business_structures[0]))--}}
                                        {{--                                                    @foreach($business_structures as $key => $value)--}}
                                        {{--                                                    <option selected>{{ $value}}</option>--}}
                                        {{--                                                    @endforeach--}}
                                        {{--                                                    @endif--}}
                                        {{--                                                </select>--}}

                                        {{--                                                @if ($errors->has('business_structures'))--}}
                                        {{--                                                <span class="help-block">--}}
                                        {{--                                                <strong class="text-danger">{{ $errors->first('business_structures') }}</strong>--}}
                                        {{--                                                </span>--}}
                                        {{--                                                @endif--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}

                                        {{--                                        @php--}}
                                        {{--                                            $tax_filing_statuses = json_decode($website->tax_filing_statuses, true);--}}
                                        {{--                                        @endphp--}}
                                        {{--                                        <div class="form-group row mt-2">--}}
                                        {{--                                            <label for="example-text-input"--}}
                                        {{--                                                   class="col-3 col-form-label text-right"><strong>{{translate('Tax Filing Status')}}</strong></label>--}}
                                        {{--                                            <div class="col-6">--}}
                                        {{--                                                <select name="tax_filing_statuses[]" id="tax_filing_statuses" multiple class="form-control select2bs4-tags">--}}
                                        {{--                                                    @if(isset($tax_filing_statuses[0]))--}}
                                        {{--                                                    @foreach($tax_filing_statuses as $key => $value)--}}
                                        {{--                                                    <option selected>{{ $value}}</option>--}}
                                        {{--                                                    @endforeach--}}
                                        {{--                                                    @endif--}}
                                        {{--                                                </select>--}}
                                        {{--                                                --}}
                                        {{--                                                @if ($errors->has('tax_filing_statuses'))--}}
                                        {{--                                                <span class="help-block">--}}
                                        {{--                                                <strong class="text-danger">{{ $errors->first('tax_filing_statuses') }}</strong>--}}
                                        {{--                                                </span>--}}
                                        {{--                                                @endif--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}

                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Website Logo')}}
                                                    ({{ translate('English') }})
                                                </strong></label>
                                            <div class="col-6">
                                                <input id="logo" class="form-control" name="logo" type="file"
                                                       accept="image/*">
                                                @if ($errors->has('logo'))
                                                    <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('logo') }}</strong>
                                                </span>
                                                @endif

                                                @if(isset($website->logo) && file_exists($website->logo))
                                                    <img src="{{asset($website->logo)}}"
                                                         style="width: 80px;height: 80px;cursor:pointer">
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Website Logo')}}
                                                    ({{ translate('Bangle') }})
                                                </strong></label>
                                            <div class="col-6">
                                                <input id="default_user_cover" class="form-control"
                                                       name="default_user_cover" type="file"
                                                       accept="image/*">
                                                @if ($errors->has('default_user_cover'))
                                                    <span class="help-block">
                                                <strong
                                                    class="text-danger">{{ $errors->first('default_user_cover') }}</strong>
                                            </span>
                                                @endif

                                                @if(isset($website->default_user_cover) && file_exists($website->default_user_cover))
                                                    <img src="{{asset($website->default_user_cover)}}"
                                                         style="width: 200px;height: 120px;cursor:pointer">
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>{{translate('Favicon')}}
                                                </strong></label>
                                            <div class="col-6">
                                                <input id="favicon" class="form-control" name="favicon" type="file"
                                                       accept="image/*">
                                                @if ($errors->has('logo'))
                                                    <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('favicon') }}</strong>
                                            </span>
                                                @endif

                                                @if(isset($website->favicon) && file_exists($website->favicon))
                                                    <img src="{{asset($website->favicon)}}"
                                                         style="width: 80px;height: 80px;cursor:pointer">
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row mt-2">
                                            <label for="example-text-input"
                                                   class="col-3 col-form-label text-right"><strong>Default User Image
                                                </strong></label>
                                            <div class="col-6">
                                                <input id="favicon" class="form-control" name="default_user_logo"
                                                       type="file"
                                                       accept="image/*">
                                                @if ($errors->has('default_user_logo'))
                                                    <span class="help-block">
                                                <strong
                                                    class="text-danger">{{ $errors->first('default_user_logo') }}</strong>
                                            </span>
                                                @endif

                                                @if(isset($website->default_user_logo) && file_exists($website->default_user_logo))
                                                    <img src="{{asset($website->default_user_logo)}}"
                                                         style="width: 120px;height: 120px;cursor:pointer">
                                                @endif
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                {{--                                @include('lang-input', [--}}
                                {{--                                    'text' => 'Monthly Plan Features',--}}
                                {{--                                    'name' => 'monthly_plan_features',--}}
                                {{--                                    'input' => $website->monthly_plan_features,--}}
                                {{--                                    'inline' => true,--}}
                                {{--                                    'textarea' => true--}}
                                {{--                                ])--}}

                                {{--                                @include('lang-input', [--}}
                                {{--                                    'text' => 'Service Agreements',--}}
                                {{--                                    'name' => 'service_agreements',--}}
                                {{--                                    'input' => $website->service_agreements,--}}
                                {{--                                    'inline' => true,--}}
                                {{--                                    'textarea' => true--}}
                                {{--                                ])--}}


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
