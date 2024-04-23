<div class="row">


    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('code', 'Code', ['class' => 'col-form-label']) !!} <span class="text-danger">*</span>
                {!! Form::text('code', isset($group->id)? request()->old('code'): $code, [
                    'id' => 'code',
                    'class' => 'form-control',
                    'required' => 'required',
                    'placeholder' => 'Enter Group Code'
                ]) !!}
                {!! $errors->first('code') !!}
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('name', 'Name', ['class' => 'col-form-label']) !!} <span class="text-danger">*</span>
                {!! Form::text('name', request()->old('name'), [
                    'id' => 'name',
                    'class' => 'form-control',
                    'required' => 'required',
                    'placeholder' => 'Enter Group Name'
                ]) !!}
                {!! $errors->first('name') !!}
            </div>
        </div>
    </div>

    <div class="col-md-12">
        {!!  Form::label('description', 'Description', array('class' => 'col-form-label')) !!}
        <div class="input-group input-group-md mb-3 d-">
            {!! Form::textarea('description', request()->old('description'), [
                    'id' => 'description',
                    'class' => 'form-control',
                    'rows'=>'3',
                    'placeholder' => 'Enter description'
                ]) !!}
        </div>
    </div>

    <div class="col-md-12 mt-2">
        {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
        &nbsp;
    </div>
</div>
