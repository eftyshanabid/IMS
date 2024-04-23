<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('unit_code', 'Unit Code', ['class' => 'col-form-label']) !!} <span
                    class="text-danger">*</span>
                {!! Form::text('unit_code', isset ($unit->id)? request ()->old('unit_code'): $code, [
                    'id' => 'unit_code',
                    'class' => 'form-control',
                    'required' => 'required',
                    'placeholder' => 'Enter your unit code'
                ]) !!}
                {!! $errors->first('unit_code') !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('unit_name', 'Unit name', ['class' => 'col-form-label']) !!} <span
                    class="text-danger">*</span>
                {!! Form::text('unit_name', request()->old('unit_name'), [
                    'id' => 'unit_name',
                    'class' => 'form-control',
                    'required' => 'required',
                    'placeholder' => 'Enter Your unit name'
                ]) !!}
                {!! $errors->first('unit_name') !!}
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
