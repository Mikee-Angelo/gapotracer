<div class="row">
    <div class="col-6">
        <!-- Name Field -->
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            <p>{{ $establishment->name }}</p>
        </div>

        <!-- Staff Name Field -->
        <div class="form-group">
            {!! Form::label('staff_name', 'Staff Name:') !!}
            <p>{{ $establishment->staff_name }}</p>
        </div>

        <!-- Address Field -->
        <div class="form-group">
            {!! Form::label('address', 'Address:') !!}
            <p>{{ $establishment->address }}</p>
        </div>

        <!-- Contact No Field -->
        <div class="form-group">
            {!! Form::label('contact_no', 'Contact No:') !!}
            <p>{{ $establishment->contact_no }}</p>
        </div>

        <!-- Type Field -->
        <div class="form-group">
            {!! Form::label('type', 'Type:') !!}
            <p>{{ $establishment->type }}</p>
        </div>

        <!-- Created At Field -->
        <div class="form-group">
            {!! Form::label('created_at', 'Created At:') !!}
            <p>{{ $establishment->created_at }}</p>
        </div>

        <!-- Updated At Field -->
        <div class="form-group">
            {!! Form::label('updated_at', 'Updated At:') !!}
            <p>{{ $establishment->updated_at }}</p>
        </div>

    </div>

    <div class="col-6 my-auto text-center">
        <img
            src="data:image/svg+xml;base64, {!! base64_encode(QrCode::format('svg')->size(300)->generate('e-'.$establishment->guid)) !!} ">
        <div class="text-center mt-3">
            <a class="btn btn-success" href="{{url('/civilians/print/e-'.$establishment->guid.'')}}"> <i
                    class="fa fa-print mr-1"></i> Print QR</a>
        </div>
    </div>
</div>
