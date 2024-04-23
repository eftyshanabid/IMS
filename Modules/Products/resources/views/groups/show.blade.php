<div class="form-group row">
    <div class="col-md-12">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
            <tr>
                <td>{{translate('Name')}}:</td>
                <td>{!! $group->name !!}</td>
            </tr>
            <tr>
                <td>{{translate('Code')}}:</td>
                <td> {!! $group->code !!}</td>
            </tr>
            <tr>
                <td>{{translate('Description')}}:</td>
                <td> {{ ucfirst($group->description) }}</td>
            </tr>
            </tbody>

        </table>
    </div>
</div>
