<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $logsEstablishment->user_id }}</p>
</div>

<!-- Host Id Field -->
<div class="form-group">
    {!! Form::label('host_id', 'Host Id:') !!}
    <p>{{ $logsEstablishment->host_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $logsEstablishment->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $logsEstablishment->updated_at }}</p>
</div>

