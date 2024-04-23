<div class="form-group row">
    <div class="col-md-12">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
            <tr>
                <td>{{translate('Name')}}:</td>
                <td>{!! $department->name !!}</td>
            </tr>
            <tr>
                <td>{{translate('Code')}}:</td>
                <td> {!! $department->code !!}</td>
            </tr>
            <tr>
                <td>{{translate('Status')}}:</td>
                <td> {{ ucfirst($department->status) }}</td>
            </tr>
            </tbody>

        </table>
    </div>
</div>
