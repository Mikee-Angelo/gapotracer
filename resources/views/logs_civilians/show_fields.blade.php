<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $logsCivilian->user_id }}</p>
</div>

<!-- Host Id Field -->
<div class="form-group">
    {!! Form::label('host_id', 'Host Id:') !!}
    <p>{{ $logsCivilian->host_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $logsCivilian->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $logsCivilian->updated_at }}</p>
</div>

