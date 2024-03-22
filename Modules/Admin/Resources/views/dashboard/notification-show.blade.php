{!! Form::model($notification, [
    'route' => ['notification.read.update', $notification->id],
    'method' => 'PUT',
    'class' => 'form-horizontal',
    'files' => false,
    ]) !!}

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('log', 'Notification Details', array('class' => 'col-form-label')) !!}
                <textarea class="form-control" readonly name="log">{!! $notification->log !!}</textarea>
                {!! $errors->first('read_receipt') !!}
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('read_receipt', 'Read Receipt', array('class' => 'col-form-label')) !!}
                {!! Form::Select('read_receipt',array('yes'=>'Yes','no'=>'No'),Request::old('read_receipt'),['id'=>'read_receipt', 'class'=>'form-control select2']) !!}
                {!! $errors->first('read_receipt') !!}
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save information']) !!}
        &nbsp;
    </div>

</div>
<script type="text/javascript">
    $(".select2").select2(
        {
            theme: 'bootstrap4',
            dropdownParent: $("#myModal")
        }
    );
</script>


{!! Form::close() !!}
