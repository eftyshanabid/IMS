<div class="row">


    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('code', 'Code', ['class' => 'col-form-label']) !!} <span class="text-danger">*</span>
                {!! Form::text('code',  isset($warehouse->id)? request()->old('code'): $code, [
                    'id' => 'code',
                    'class' => 'form-control',
                    'required' => 'required',
                    'placeholder' => 'Enter Warehouse Code'
                ]) !!}
                {!! $errors->first('code') !!}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('name', 'Name', ['class' => 'col-form-label']) !!} <span class="text-danger">*</span>
                {!! Form::text('name', request()->old('name'), [
                    'id' => 'name',
                    'class' => 'form-control',
                    'required' => 'required',
                    'placeholder' => 'Enter Warehouse Name'
                ]) !!}
                {!! $errors->first('name') !!}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('phone', 'Phone', ['class' => 'col-form-label']) !!}
                {!! Form::text('phone', request()->old('phone'), [
                    'id' => 'phone',
                    'class' => 'form-control',
                    'placeholder' => 'Enter Warehouse Phone'
                ]) !!}
                {!! $errors->first('phone') !!}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('email', 'Email', ['class' => 'col-form-label']) !!}
                {!! Form::text('email', request()->old('email'), [
                    'id' => 'email',
                    'class' => 'form-control',
                    'placeholder' => 'Enter Warehouse Email'
                ]) !!}
                {!! $errors->first('email') !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('address', 'Address', ['class' => 'col-form-label']) !!} <span class="text-danger">*</span>
                {!! Form::text('address', request()->old('address'), [
                    'id' => 'address',
                    'class' => 'form-control',
                    'required' => 'required',
                    'placeholder' => 'Enter Warehouse Address'
                ]) !!}
                {!! $errors->first('address') !!}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('location', 'Location', ['class' => 'col-form-label']) !!}
                {!! Form::text('location', request()->old('location'), [
                    'id' => 'location',
                    'class' => 'form-control',
                    'placeholder' => 'Enter Warehouse Location'
                ]) !!}
                {!! $errors->first('location') !!}
            </div>
        </div>
    </div>
    <div class="col-md-3">
            <div class="form-group">
                <div class="form-line">
                    {!!  Form::label('status', 'Status', array('class' => 'col-form-label')) !!}
                    {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive'),Request::old('status'),['id'=>'status', 'class'=>'form-control select2']) !!}
                    {!! $errors->first('status') !!}
                </div>
            </div>
    </div>

    <div class="col-md-12 mt-2">
        {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
        &nbsp;
    </div>
</div>
