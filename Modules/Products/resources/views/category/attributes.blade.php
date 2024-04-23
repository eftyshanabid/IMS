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
                                        <form action="{{ url('admin/categories/'.$subcategory->id.'/update-attributes')
                                        }}" method="post" accept-charset="utf-8">
                                            @csrf

                                            <h5><strong>{{ $subcategory->name }} Attributes</strong></h5>
                                            <hr>
                                            <div class="form-group">
                                                <label for="attributes">
                                                    <strong>Attributes:</strong>
                                                </label>
                                                <div class="input-group input-group-md mb-3 d-">
                                                    <select name="productAttributes[]" id="attributes"
                                                            class="form-control rounded select2" multiple
                                                            data-placeholder="Choose Attributes"
                                                            onchange="updateAttributes()">
                                                        @if(isset($attributes[0]))
                                                            @foreach($attributes as $key => $attribute)
                                                                <option
                                                                    value="{{ $attribute->id }}" {{ in_array($attribute->id, isset($categoryAttributes[0]) ? $categoryAttributes : []) ? 'selected' : '' }}>{{ $attribute->name }}</attribute>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                @php
                                                    $categoryAttributes = Modules\Products\app\Models\CategoryAttribute::where([
                                                        'category_id' => $subcategory->id,
                                                    ])->get();
                                                @endphp
                                                @if(isset($attributes[0]))
                                                    @foreach($attributes as $key => $attribute)
                                                        @php
                                                            $categoryAttribute = $categoryAttributes->where('attribute_id', $attribute->id)->first();

                                                            $options = (isset($categoryAttribute->id) && !empty($categoryAttribute->options) ? json_decode($categoryAttribute->options, true) : []);
                                                        @endphp
                                                        <div
                                                            class="col-md-6 mb-3 attributes attribute-{{ $attribute->id }}"
                                                            style="display: none">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card">
                                                                        <div class="card-body p-0"
                                                                             style="border: 1px solid #ccc;padding: 5px 10px 5px 10px !important">
                                                                            <div class="row">
                                                                                <div class="col-md-9">
                                                                                    <label class="mb-1"
                                                                                           for="attribute-{{ $attribute->id }}">
                                                                                        <strong>{{ $attribute->name }}
                                                                                            :</strong>
                                                                                    </label>
                                                                                    <div
                                                                                        class="input-group input-group-md mb-3 d-">
                                                                                        <select
                                                                                            name="attributeOptions[{{ $attribute->id }}][]"
                                                                                            id="attribute-{{ $attribute->id }}"
                                                                                            class="form-control rounded select2"
                                                                                            multiple>
                                                                                            @if(isset($attribute->options[0]))
                                                                                                @foreach($attribute->options as $key => $option)
                                                                                                    <option
                                                                                                        value="{{ $option->id }}" {{ isset($options[0]) && in_array($option->id, $options) ? 'selected' : '' }}>{{ $option->name }}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3 pl-0">
                                                                                    <label class="mb-1"
                                                                                           for="attribute-serial-{{ $attribute->id }}">
                                                                                        <strong>Serial:</strong>
                                                                                    </label>
                                                                                    <div
                                                                                        class="input-group input-group-md mb-3 d-">
                                                                                        <input type="number"
                                                                                               name="attributeSerials[{{ $attribute->id }}]"
                                                                                               id="attribute-serial{{ $attribute->id }}"
                                                                                               value="{{ isset($categoryAttribute->serial) ? $categoryAttribute->serial : 1 }}"
                                                                                               class="form-control text-right"
                                                                                               min="1">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <button type="submit" class="btn btn-md btn-success"><i
                                                    class="mdi mdi-pencil-box"></i>&nbsp;Update Category Attributes
                                            </button>
                                        </form>
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
        updateAttributes();

        function updateAttributes() {
            var attributes = $("#attributes :selected").map(function (i, el) {
                return $(el).val();
            }).get();

            $('.attributes').hide();
            $.each(attributes, function (index, attribute) {
                $('.attribute-' + attribute).show();
                $('.attribute-serial-' + attribute).show();

                //$('.select2').select2({width: '100%'});
            });
        }
    </script>
@endsection
