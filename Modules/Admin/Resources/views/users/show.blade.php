<div class="form-group row">
    <div class="col-md-12">
        <table class="table table-bordered table-striped table-hover">

            <tbody>
                <tr>
                    <td>{{translate('Name')}}:</td>
                    <td>  {{$user->name}}</td>
                </tr>
                <tr>
                    <td>{{translate('Email')}}:</td>
                    <td>  {{$user->email}}</td>
                </tr>
                <tr>
                    <td>{{translate('Phone')}}:</td>
                    <td>  {{$user->phone}}</td>
                </tr>


                <tr>
                    <td>{{translate('Profile Photo')}}:</td>
                    <td>
                        @if(isset($user->avatar) && file_exists($user->avatar))
                        <img id="image_load" src="{{asset($user->avatar)}}" style="width: 150px;height: 150px;cursor:pointer">
                        @else

                        <img id="image_load" src="{{asset('user/09.jpg')}}" style="width: 150px; height: 150px;cursor:pointer;">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>{{translate('Assigned Role')}} (s):</td>
                    <td>
                        @forelse($userRole as $role)
                        <span class="btn btn-primary"> {{$role}}</span>
                        @empty
                        @endforelse
                    </td>
                </tr>

            </tbody>

        </table>
    </div>
</div>
