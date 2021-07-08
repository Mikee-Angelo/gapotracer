
<div class="row">
    <div class="col-6">
        <!-- Name Field -->
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            <p>{{ $vehicles->name }}</p>
        </div>

        <!-- Body No Field -->
        <div class="form-group">
            {!! Form::label('body_no', 'Body No:') !!}
            <p>{{ $vehicles->body_no }}</p>
        </div>

        <!-- Plate No Field -->
        <div class="form-group">
            {!! Form::label('plate_no', 'Plate No:') !!}
            <p>{{ $vehicles->plate_no }}</p>
        </div>

        <!-- Contact No Field -->
        <div class="form-group">
            {!! Form::label('contact_no', 'Contact No:') !!}
            <p>{{ $vehicles->contact_no }}</p>
        </div>

        <!-- Address Field -->
        <div class="form-group">
            {!! Form::label('address', 'Address:') !!}
            <p>{{ $vehicles->address }}</p>
        </div>

        <!-- Type Field -->
        <div class="form-group">
            {!! Form::label('type', 'Type:') !!}
            <p>{{ $vehicles->type }}</p>
        </div>

        <!-- Created At Field -->
        <div class="form-group">
            {!! Form::label('created_at', 'Created At:') !!}
            <p>{{ $vehicles->created_at }}</p>
        </div>

        <!-- Updated At Field -->
        <div class="form-group">
            {!! Form::label('updated_at', 'Updated At:') !!}
            <p>{{ $vehicles->updated_at }}</p>
        </div>

    </div>

    <div class="col-6 my-auto text-center">
        <img
            src="data:image/svg+xml;base64, {!! base64_encode(QrCode::format('svg')->size(300)->generate('v-'.$vehicles->guid)) !!} ">
        <div class="text-center mt-3">
            <a class="btn btn-success" href="{{url('/civilians/print/v-'.$vehicles->guid.'')}}"> <i
                    class="fa fa-print mr-1"></i> Print QR</a>
        </div>
    </div>
</div>
