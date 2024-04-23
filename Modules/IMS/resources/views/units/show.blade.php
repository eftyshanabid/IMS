<div class="form-group row">
    <div class="col-md-12">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <td>{{translate('Unit Name')}}:</td>
                    <td>{!! $unit->unit_name !!}</td>
                </tr>
            <tr>
                <td>{{translate('Unit Code')}}:</td>
                <td> {!! $unit->unit_code !!}</td>
            </tr>
            <tr>
                <td>{{translate('Status')}}:</td>
                <td> {{ ucfirst($unit->status) }}</td>
            </tr>
            </tbody>

        </table>
    </div>
</div>
