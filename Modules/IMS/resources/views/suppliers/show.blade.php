<div class="form-group row">
    <div class="col-md-12">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
            <tr>
                <td>{{translate('Name')}}:</td>
                <td>{!! $supplier->name !!}</td>
            </tr>
            <tr>
                <td>{{translate('Code')}}:</td>
                <td> {!! $supplier->code !!}</td>
            </tr>
            <tr>
                <td>{{translate('Phone')}}:</td>
                <td> {!! $supplier->phone !!}</td>
            </tr>
            <tr>
                <td>{{translate('Email')}}:</td>
                <td> {!! $supplier->email !!}</td>
            </tr>
            <tr>
                <td>{{translate('Mobile No')}}:</td>
                <td> {!! $supplier->mobile_no !!}</td>
            </tr>
            <tr>
                <td>{{translate('Tin')}}:</td>
                <td> {!! $supplier->tin !!}</td>
            </tr>
            <tr>
                <td>{{translate('Trade')}}:</td>
                <td> {!! $supplier->trade !!}</td>
            </tr>
            <tr>
                <td>{{translate('Segments')}}:</td>
                <td>{!! $supplier->segments !!}</td>
            </tr>
            <tr>
                <td>{{translate('Bin')}}:</td>
                <td> {!! $supplier->bin !!}</td>
            </tr>
            <tr>
                <td>{{translate('Vat')}}:</td>
                <td> {!! $supplier->vat !!}</td>
            </tr>
            <tr>
                <td>{{translate('Website')}}:</td>
                <td> {!! $supplier->website !!}</td>
            </tr>
            <tr>
                <td>{{translate('Agreement')}}:</td>
                <td> {!! $supplier->agreement !!}</td>
            </tr>
            <tr>
                <td>{{translate('Term conditions')}}:</td>
                <td> {!! $supplier->term_conditions !!}</td>
            </tr>
            <tr>
                <td>{{translate('Address')}}:</td>
                <td> {!! $supplier->address !!}</td>
            </tr>
            <tr>
                <td>{{translate('Status')}}:</td>
                <td> {{ ucfirst($supplier->status) }}</td>
            </tr>
            </tbody>

        </table>
    </div>
</div>
