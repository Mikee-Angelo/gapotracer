<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Vehicle Type:') !!}
    {!! Form::select( 'type',['Jeep','Bus','Tricycle','Taxi','Van','Truck'], ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Operator Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Body No Field -->
<div class="form-group col-sm-6">
    {!! Form::label('body_no', 'Body No:') !!}
    {!! Form::text('body_no', null, ['class' => 'form-control']) !!}
</div>

<!-- Plate No Field -->
<div class="form-group col-sm-6">
    {!! Form::label('plate_no', 'Plate No:') !!}
    {!! Form::text('plate_no', null, ['class' => 'form-control']) !!}
</div>

<!-- Contact No Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contact_no', 'Contact No:') !!}
    {!! Form::number('contact_no', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Operator Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Cancel</a>
</div>
