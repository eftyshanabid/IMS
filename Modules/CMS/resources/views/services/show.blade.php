<div class="form-group row">
    <div class="col-md-12">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
            <tr>
                <td>{{translate('Title')}}:</td>
                <td>{!! languageValues($service->title) !!}</td>
            </tr>
            <tr>
                <td>{{translate('Price')}}:</td>
                <td> {!! $service->price !!} $</td>
            </tr>
            <tr>
                <td>{{translate('Type')}}:</td>
                <td> {!! serviceTypes()[$service->type] !!}</td>
            </tr>
            <tr>
                <td>{{translate('Status')}}:</td>
                <td> {{ ucfirst($service->status) }}</td>
            </tr>
            </tbody>

        </table>
    </div>
</div>
