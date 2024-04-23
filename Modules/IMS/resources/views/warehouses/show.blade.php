<div class="form-group row">
    <div class="col-md-12">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
            <tr>
                <td>{{translate('Name')}}:</td>
                <td>{!! $warehouse->name !!}</td>
            </tr>
            <tr>
                <td>{{translate('Code')}}:</td>
                <td> {!! $warehouse->code !!}</td>
            </tr>
            <tr>
                <td>{{translate('Phone')}}:</td>
                <td> {!! $warehouse->phone !!}</td>
            </tr>
            <tr>
                <td>{{translate('Email')}}:</td>
                <td> {!! $warehouse->email !!}</td>
            </tr>
            <tr>
                <td>{{translate('Address')}}:</td>
                <td> {!! $warehouse->address !!}</td>
            </tr>
            <tr>
                <td>{{translate('Location')}}:</td>
                <td> {!! $warehouse->location !!}</td>
            </tr>
            <tr>
                <td>{{translate('Status')}}:</td>
                <td> {{ ucfirst($warehouse->status) }}</td>
            </tr>
            </tbody>

        </table>
    </div>
</div>
