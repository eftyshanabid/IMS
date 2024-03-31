<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('code', 'Code', ['class' => 'col-form-label']) !!} <span class="text-danger">*</span>
                {!! Form::text('code', request()->old('code'), [
                    'id' => 'code',
                    'class' => 'form-control',
                    'required' => 'required',
                    'placeholder' => 'Enter Language Code'
                ]) !!}
                {!! $errors->first('code') !!}
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('name', 'Name', ['class' => 'col-form-label']) !!} <span class="text-danger">*</span>
                {!! Form::text('name', request()->old('name'), [
                    'id' => 'name',
                    'class' => 'form-control',
                    'required' => 'required',
                    'placeholder' => 'Enter Language Name'
                ]) !!}
                {!! $errors->first('name') !!}
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('flag', 'Flag', ['class' => 'col-form-label']) !!} <span class="text-danger">*</span>
                {!! Form::text('flag', request()->old('flag'), [
                    'id' => 'flag',
                    'class' => 'form-control',
                    'required' => 'required',
                    'placeholder' => 'Enter Language Flag'
                ]) !!}
                {!! $errors->first('flag') !!}
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-2">
        {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
        &nbsp;
    </div>
</div>
