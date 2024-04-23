<div class="form-group row">
    <div class="col-md-12">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
            <tr>
                <td>{{translate('Charge Name')}}:</td>
                <td>{!! $charge->charge_name !!}</td>
            </tr>
            <tr>
                <td>{{translate('Charge Code')}}:</td>
                <td> {!! $charge->charge_code !!}</td>
            </tr>
            <tr>
                <td>{{translate('Type')}}:</td>
                <td> {{ ucfirst($charge->type) }}</td>
            </tr>
            <tr>
                <td>{{translate('Status')}}:</td>
                <td> {{ ucfirst($charge->status) }}</td>
            </tr>
            </tbody>

        </table>
    </div>
</div>
