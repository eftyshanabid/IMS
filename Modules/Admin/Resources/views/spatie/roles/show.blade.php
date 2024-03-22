<div class="form-group row">
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <th style="width: 33%">{{translate('Role')}}</th>
                <th>{{translate('Permissions')}}</th>
            </tr>
            <tbody>
                <tr>
                    <td>
                        <h4><strong>{{$role->name}}</strong></h4>
                        <hr>
                        <p>
                            <strong>{{translate('Word Restrictions')}}:</strong>
                            {{ implode(', ', array_map(function($value){
                                return ucwords($value);
                            }, isset(json_decode($role->word_restrictions, true)[0]) ? json_decode($role->word_restrictions, true) : [])) }}
                        </p>
                    </td>
                    <td>
                        @if(!empty($rolePermissions))
                        @foreach($rolePermissions as $v)
                           <span class="badge bg-primary">{{ $v->name }},</span>
                        @endforeach
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
