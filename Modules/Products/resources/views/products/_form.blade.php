<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('sku', 'Sku', ['class' => 'col-form-label']) !!} <span class="text-danger">*</span>
                {!! Form::text('sku', isset($sku) ? $sku : request()->old('sku'), [
                    'id' => 'sku',
                    'class' => 'form-control',
                    'placeholder' => 'Enter Products sku',
                ]) !!}
                {!! $errors->first('sku') !!}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('unit_id', 'Unit', ['class' => 'col-form-label']) !!}
                {!! Form::Select('unit_id', $units, Request::old('unit_id'), [
                    'id' => 'unit_id',
                    'class' => 'form-control select2',
                ]) !!}
                {!! $errors->first('unit_id') !!}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('product_group_id', 'ProductGroup', ['class' => 'col-form-label']) !!}
                {!! Form::Select('product_group_id', $productGroups, Request::old('product_group_id'), [
                    'id' => 'product_group_id',
                    'class' => 'form-control select2',
                ]) !!}
                {!! $errors->first('product_group_id') !!}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('category_id', 'Category', ['class' => 'col-form-label']) !!}
                {!! Form::Select('category_id', $categories, Request::old('category_id'), [
                    'id' => 'category_id',
                    'class' => 'form-control select2',
                ]) !!}
                {!! $errors->first('category_id') !!}
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('name', 'Name', ['class' => 'col-form-label']) !!}
                {!! Form::text('name', request()->old('name'), [
                    'id' => 'name',
                    'class' => 'form-control',
                    'placeholder' => 'Enter Products name',
                ]) !!}
                {!! $errors->first('name') !!}
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('unit_price', 'Unit Price', ['class' => 'col-form-label']) !!}
                {!! Form::text('unit_price', request()->old('unit_price'), [
                    'id' => 'unit_price',
                    'class' => 'form-control mask-money',
                    'placeholder' => 'Enter Products Unit Price',
                ]) !!}
                {!! $errors->first('unit_price') !!}
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('vat', 'Vat', ['class' => 'col-form-label']) !!}
                {!! Form::text('vat', request()->old('vat'), [
                    'id' => 'vat',
                    'class' => 'form-control mask-money',
                    'placeholder' => 'Enter Products Vat',
                ]) !!}
                {!! $errors->first('vat') !!}
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('tax', 'Tax', ['class' => 'col-form-label']) !!}
                {!! Form::text('tax', request()->old('tax'), [
                    'id' => 'tax',
                    'class' => 'form-control mask-money',
                    'placeholder' => 'Enter Products Tax',
                ]) !!}
                {!! $errors->first('tax') !!}
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('sales_price', 'Sales Price', ['class' => 'col-form-label']) !!}
                {!! Form::text('sales_price', request()->old('sales_price'), [
                    'id' => 'sales_price',
                    'class' => 'form-control mask-money',
                    'placeholder' => 'Enter Products Sales Price',
                ]) !!}
                {!! $errors->first('sales_price') !!}
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('mode_of_purchase', 'Mode Of Purchase', ['class' => 'col-form-label']) !!}
                {!! Form::Select(
                    'mode_of_purchase',
                    ['import' => 'Import', 'native' => 'Native'],
                    Request::old('mode_of_purchase'),
                    ['id' => 'mode_of_purchase', 'class' => 'form-control select2'],
                ) !!}
                {!! $errors->first('mode_of_purchase') !!}
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('status', 'Status', ['class' => 'col-form-label']) !!}
                {!! Form::Select('status', ['pending' => 'Pending', 'approved' => 'Approved'], Request::old('status'), [
                    'id' => 'status',
                    'class' => 'form-control select2',
                ]) !!}
                {!! $errors->first('status') !!}
            </div>
        </div>
    </div>
    <div class="col-md-8">
        {!! Form::label('attributes', 'Attributes', ['class' => 'col-form-label']) !!}
        <select name="productAttributes[]" id="attributes" class="form-control rounded product-attributes select2"
            multiple data-placeholder="Choose Item Attributes" onchange="updateAttributes()">
            @if (isset($attributes[0]))
                @foreach ($attributes as $key => $attribute)
                    <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="col-md-12">
        <div class="row">
            @if (isset($attributes[0]))
                @foreach ($attributes as $key => $attribute)
                    <div class="col-md-3 mt-1 attributes attribute-{{ $attribute->id }}" style="display: none">
                        <label for="attribute-{{ $attribute->id }}">{{ $attribute->name }}
                            :</label>
                        <div class="input-group input-group-md">
                            <select name="attribute_option_id[{{ $attribute->id }}]" id="attribute-{{ $attribute->id }}"
                                class="form-control rounded attribute-options select2">
                                <option value="0">Not Required</option>
                                @if (isset($attribute->options[0]))
                                    @foreach ($attribute->options as $key => $option)
                                        <option value="{{ $option->id }}">{{ $option->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="col-md-12">
        {!! Form::label('$supplier', 'Suppliers', ['class' => 'col-form-label']) !!}
        <select name="supplier[]" id="supplier" class="form-control rounded select2" multiple>
            @if (isset($suppliers[0]))
                @foreach ($suppliers as $key => $supplier)
                    <option value="{{ $supplier->id }}"
                        {{ isset($existedSuppliers) ? (in_array($supplier->id, $existedSuppliers) ? 'selected' : '') : '' }}>
                        {{ $supplier->name }}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('description', 'Description', ['class' => 'col-form-label']) !!}
                {!! Form::textarea('description', request()->old('description'), [
                    'id' => 'description',
                    'class' => 'form-control',
                    'rows' => '3',
                    'placeholder' => 'Enter Products Description',
                ]) !!}
                {!! $errors->first('description') !!}
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-2">
        {!! Form::submit('Save changes', [
            'class' => 'btn btn-primary pull-right font-10 m-t-15',
            'data-placement' => 'top',
            'data-content' => 'click save changes button for save role information',
        ]) !!}
        &nbsp;
    </div>
</div>

@section('javascript')
    <script type="text/javascript">
        function checkAttributes() {
            if ($('#category_id').find(':selected').attr('data-attributes') != undefined) {
                var attributes = $('#category_id').find(':selected').attr('data-attributes').split(',');
                var attributeOptions = $('#category_id').find(':selected').attr('data-attribute-options').split(',');

                $.each($(".product-attributes"), function(name, attribute_id) {
                    $.each($(this).find('option'), function(index, val) {
                        if ($.inArray($(this).attr('value'), attributes) != -1) {
                            $(".product-attributes option[value='" + $(this).attr('value') + "']")
                                .removeAttr('hidden');
                        } else {
                            $(".product-attributes option[value='" + $(this).attr('value') + "']").attr(
                                'hidden', 'hidden');
                        }
                    });

                    $(this).select2({
                        templateResult: function(option) {
                            if (option.element && (option.element).hasAttribute('hidden')) {
                                return null;
                            }
                            return option.text;
                        }
                    });
                });

                $.each($('.attribute-options'), function(index, val) {
                    $.each($(this).find('option'), function(index, val) {
                        if ($.inArray($(this).attr('value'), attributeOptions) != -1) {
                            $(this).parent().find("option[value='" + $(this).attr('value') + "']")
                                .removeAttr('hidden');
                        } else {
                            $(this).parent().find("option[value='" + $(this).attr('value') + "']").attr(
                                'hidden', 'hidden');
                        }
                    });

                    $(this).select2({
                        templateResult: function(option) {
                            if (option.element && (option.element).hasAttribute('hidden')) {
                                return null;
                            }
                            return option.text;
                        }
                    });
                });

                $(".product-attributes").val("").select2();

                $('.product-attributes').select2({
                    allowClear: true,
                    templateResult: function(option) {
                        if (option.element && (option.element).hasAttribute('hidden')) {
                            return null;
                        }

                        return option.text;
                    },
                });
            } else {
                $.each($(".product-attributes"), function(name, attribute_id) {
                    $.each($(this).find('option'), function(index, val) {
                        $(".product-attributes option[value='" + $(this).attr('value') + "']").removeAttr(
                            'hidden');
                    });

                    $(this).select2({
                        templateResult: function(option) {
                            return null;
                        }
                    });
                });
            }
        }

        function updateAttributes() {
            var attributes = $("#attributes :selected").map(function(i, el) {
                return $(el).val();
            }).get();

            $('.attributes').hide();
            $.each(attributes, function(index, attribute) {
                $('.attribute-' + attribute).show();
            });
        }
    </script>
@endsection
