<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $logsVehicle->user_id }}</p>
</div>

<!-- Host Id Field -->
<div class="form-group">
    {!! Form::label('host_id', 'Host Id:') !!}
    <p>{{ $logsVehicle->host_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $logsVehicle->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $logsVehicle->updated_at }}</p>
</div>

