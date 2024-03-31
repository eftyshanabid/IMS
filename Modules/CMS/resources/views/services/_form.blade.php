<div class="row">
    @include('lang-input', [
        'text' => 'Title',
        'name' => 'title',
        'input' => $service->title,
        'required' => true,
    ])

    <div class="col-md-4">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('price', 'Price', array('class' => 'col-form-label')) !!} <span class="text-danger">*</span>
                {!! Form::number('price',Request::old('price'),['id'=>'price','class' => 'form-control','required'=>
                'required', 'placeholder'=>'Enter service price']) !!}
                {!! $errors->first('status') !!}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('type', 'Type', array('class' => 'col-form-label')) !!}
                {!! Form::Select('type',serviceTypes(),Request::old('type'),['id'=>'type', 'class'=>'form-control select2']) !!}
                {!! $errors->first('type') !!}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('status', 'Status', array('class' => 'col-form-label')) !!}
                {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive'),Request::old('status'),['id'=>'status', 'class'=>'form-control select2']) !!}
                {!! $errors->first('status') !!}
            </div>
        </div>
    </div>

    <div class="col-md-12">
        {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
        &nbsp;
    </div>

</div>
