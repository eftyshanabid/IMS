<div class="row">


    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('charge_code', 'Charge_Code', ['class' => 'col-form-label']) !!} <span class="text-danger">*</span>
                {!! Form::text('charge_code', isset($charge->id)? request()->old('charge_code'): $code, [
                    'id' => 'charge_code',
                    'class' => 'form-control',
                    'required' => 'required',
                    'placeholder' => 'Enter Charge Code'
                ]) !!}
                {!! $errors->first('charge_code') !!}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('charge_name', 'Charge_Name', ['class' => 'col-form-label']) !!} <span class="text-danger">*</span>
                {!! Form::text('charge_name', request()->old('charge_name'), [
                    'id' => 'charge_name',
                    'class' => 'form-control',
                    'required' => 'required',
                    'placeholder' => 'Enter Charge Name'
                ]) !!}
                {!! $errors->first('charge_name') !!}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('type', 'Type', array('class' => 'col-form-label')) !!}
                {!! Form::Select('type',array('bank'=>'Bank','others'=>'Others'),Request::old('type'),['id'=>'type', 'class'=>'form-control select2']) !!}
                {!! $errors->first('type') !!}
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
