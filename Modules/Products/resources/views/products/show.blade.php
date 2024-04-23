<div class="form-group row">
    <div class="col-md-12">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
            <tr>
                <td>{{translate('Sku')}}:</td>
                <td>{!! $product->sku !!}</td>
            </tr>
            <tr>
                <td>{{translate('Name')}}:</td>
                <td> {!! $product->name !!}</td>
            </tr>
            <tr>
                <td>{{translate('Category')}}:</td>
                <td> {!! $product->category->name !!}</td>
            </tr>
            <tr>
                <td>{{translate('Product Group')}}:</td>
                <td> {!! $product->productGroup->name !!}</td>
            </tr>
            <tr>
                <td>{{translate('Product Attributes')}}:</td>
                <td> {!! getProductAttributesFaster($product) !!}</td>
            </tr>
            <tr>
                <td>{{translate('Product Supplier')}}:</td>
                <td>

                    @if($suppliers[0])
                        @foreach($suppliers as $supplier)
                            <span class="badge badge-outline-info m-1">{{$supplier->name}}</span>
                        @endforeach
                    @endif

                </td>
            </tr>
            <tr>
                <td>{{translate('Unit')}}:</td>
                <td> {!! $product->productUnit->unit_name !!}</td>
            </tr>
            <tr>
                <td>{{translate('Unit Price')}}:</td>
                <td> {!! systemMoneyFormat($product->unit_price) !!}</td>
            </tr>
            <tr>
                <td>{{translate('Tax')}}:</td>
                <td>{!! systemMoneyFormat($product->tax) !!}</td>
            </tr>
            <tr>
                <td>{{translate('Vat')}}:</td>
                <td> {!! systemMoneyFormat($product->vat) !!}</td>
            </tr>
            <tr>
                <td>{{translate('Sales Price')}}:</td>
                <td> {!! systemMoneyFormat($product->sales_price) !!}</td>
            </tr>
            <tr>
                <td>{{translate('Description')}}:</td>
                <td> {!! $product->description !!}</td>
            </tr>
            <tr>
                <td>{{translate('Mode Of Purchase')}}:</td>
                <td> {!! ucfirst($product->mode_of_purchase) !!}</td>
            </tr>
            <tr>
                <td>{{translate('Status')}}:</td>
                <td> {{ ucfirst($product->status) }}</td>
            </tr>
            </tbody>

        </table>
    </div>
</div>
