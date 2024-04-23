<div class="form-group row">
    <div class="col-md-12">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
            <tr>
                <td>{{translate('Name')}}:</td>
                <td>{!! $customer->name !!}</td>
            </tr>
            <tr>
                <td>{{translate('Code')}}:</td>
                <td> {!! $customer->code !!}</td>
            </tr>
            <tr>
                <td>{{translate('Phone')}}:</td>
                <td> {!! $customer->phone !!}</td>
            </tr>
            <tr>
                <td>{{translate('Email')}}:</td>
                <td> {!! $customer->email !!}</td>
            </tr>
            <tr>
                <td>{{translate('Mobile_No')}}:</td>
                <td> {!! $customer->mobile_no !!}</td>
            </tr>
            <tr>
                <td>{{translate('Tin')}}:</td>
                <td> {!! $customer->tin !!}</td>
            </tr>
            <tr>
                <td>{{translate('Trade')}}:</td>
                <td> {!! $customer->trade !!}</td>
            </tr>
            <tr>
                <td>{{translate('Bin')}}:</td>
                <td> {!! $customer->bin !!}</td>
            </tr>
            <tr>
                <td>{{translate('Vat')}}:</td>
                <td> {!! $customer->vat !!}</td>
            </tr>
            <tr>
                <td>{{translate('Website')}}:</td>
                <td> {!! $customer->website !!}</td>
            </tr>
            <tr>
                <td>{{translate('Agreement')}}:</td>
                <td> {!! $customer->agreement !!}</td>
            </tr>
            <tr>
                <td>{{translate('Term_conditions')}}:</td>
                <td> {!! $customer->term_conditions !!}</td>
            </tr>
            <tr>
                <td>{{translate('Address')}}:</td>
                <td> {!! $customer->address !!}</td>
            </tr>
            <tr>
                <td>{{translate('Status')}}:</td>
                <td> {{ ucfirst($customer->status) }}</td>
            </tr>
            </tbody>

        </table>
    </div>
</div>
