
<!-- User ID Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User ID:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Host ID Field -->
<div class="form-group col-sm-6">
    {!! Form::label('host_id', 'Host ID:') !!}
    {!! Form::text('host_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('logsCivilians.index') }}" class="btn btn-secondary">Cancel</a>
</div>
