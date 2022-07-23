<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $records->user_id }}</p>
</div>

<!-- Suspected At Field -->
<div class="form-group">
    {!! Form::label('suspected_at', 'Suspected At:') !!}
    <p>{{ $records->suspected_at }}</p>
</div>

<!-- Negative At Field -->
<div class="form-group">
    {!! Form::label('negative_at', 'Negative At:') !!}
    <p>{{ $records->negative_at }}</p>
</div>

<!-- Positive At Field -->
<div class="form-group">
    {!! Form::label('positive_at', 'Positive At:') !!}
    <p>{{ $records->positive_at }}</p>
</div>

<!-- Death At Field -->
<div class="form-group">
    {!! Form::label('death_at', 'Death At:') !!}
    <p>{{ $records->death_at }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $records->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $records->updated_at }}</p>
</div>

