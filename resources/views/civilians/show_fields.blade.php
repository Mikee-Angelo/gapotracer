<div class="mb-4 inline-block">
    <h4>Actions: </h4>
    <button type="button" class="btn btn-warning" id="suspected" {{ ($civilian->status == 0 || $civilian->status == 2 || $civilian->status == 4 )? '' : 'disabled'}} >Suspected</button>
    <button type="button" class="btn btn-primary ml-2 " id="negative" {{ ($civilian->status  == 1 ) ? '' : 'disabled'}}>Negative</button>
    <button type="button" class="btn btn-danger ml-2 " id="positive"{{ ($civilian->status  == 1 ) ? '' : 'disabled'}} >Positive</button>
    <button type="button" class="btn btn-success ml-2 " id="recovered"{{ ($civilian->status  == 3 ) ? '' : 'disabled'}}  >Recovered</button>
    <button type="button" class="btn btn-dark ml-2 " id="death">Death</button>
</div>
<hr  class="mb-4">

<div class="row">
  <div class="col-6">
    <h5 class="mb-3">Status: 
        @if($civilian->status == 0)
            <span class="font-weight-bold ml-4">Normal</span>
        @endif

        @if($civilian->status == 1)
            <span class="font-weight-bold ml-4">Suspected</span>
        @endif

        @if($civilian->status == 2)
            <span class="font-weight-bold ml-4">Negative</span>
        @endif

        @if($civilian->status == 3)
            <span class="font-weight-bold ml-4">Positive</span>
        @endif

        @if($civilian->status == 4)
            <span class="font-weight-bold ml-4">Recovered</span>
        @endif

        @if($civilian->status == 5)
            <span class="font-weight-bold ml-4">Death</span>
        @endif
    </h5>
    <hr>
            <!-- First Name Field -->
    <div class="form-group">
        {!! Form::label('first_name', 'First Name:') !!}
        <p>{{ $civilian->first_name }}</p>
    </div>

    <!-- Last Name Field -->
    <div class="form-group">
        {!! Form::label('last_name', 'Last Name:') !!}
        <p>{{ $civilian->last_name }}</p>
    </div>

    <!-- Phone Field -->
    <div class="form-group">
        {!! Form::label('phone', 'Phone:') !!}
        <p>{{ $civilian->phone }}</p>
    </div>

    <!-- Age Field -->
    <div class="form-group">
        {!! Form::label('age', 'Age:') !!}
        <p>{{ $civilian->age }}</p>
    </div>

    <!-- Gender Field -->
    <div class="form-group">
        {!! Form::label('gender', 'Gender:') !!}
        <p>{{ $civilian->gender }}</p>
    </div>

    <!-- Address Field -->
    <div class="form-group">
        {!! Form::label('address', 'Address:') !!}
        <p>{{ $civilian->address }}</p>
    </div>

    <!-- Created At Field -->
    <div class="form-group">
        {!! Form::label('created_at', 'Created At:') !!}
        <p>{{ $civilian->created_at }}</p>
    </div>

    <!-- Updated At Field -->
    <div class="form-group">
        {!! Form::label('updated_at', 'Updated At:') !!}
        <p>{{ $civilian->updated_at }}</p>
    </div>
  </div>
    <div class="col-6 my-auto text-center">
        <img src="data:image/svg+xml;base64, {!! base64_encode(QrCode::format('svg')->size(300)->generate('c-'.$civilian->guid)) !!} ">
        <div class="text-center mt-3">
         <a class="btn btn-success" href="{{url('/civilians/print/c-'.$civilian->guid.'')}}"> <i class="fa fa-print mr-1"></i> Print QR</a>
        </div>
    </div>
</div>

@include('records.table')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function(){ 
        $('#suspected').on('click', function(){ 
            $.post('{{$civilian->id}}/status',{
                '_token': '{{csrf_token()}}',
                'status' : 1,
            }, function (data, status){
                    window.location.reload();
              
            });
        });

        $('#negative').on('click', function(){ 
            $.post('{{$civilian->id}}/status',{
                '_token': '{{csrf_token()}}',
                'status' : 2,
            }, function (data, status){
                    window.location.reload();
              
            });
        });

        $('#positive').on('click', function(){ 
            $.post('{{$civilian->id}}/status',{
                '_token': '{{csrf_token()}}',
                'status' : 3,
            }, function (data, status){
                    window.location.reload();
              
            });
        });

        $('#recovered').on('click', function(){ 
            $.post('{{$civilian->id}}/status',{
                '_token': '{{csrf_token()}}',
                'status' : 4,
            }, function (data, status){
                    window.location.reload();
            });
        });

        $('#death').on('click', function(){ 
            $.post('{{$civilian->id}}/status',{
                '_token': '{{csrf_token()}}',
                'status' : 5,
            }, function (data, status){
                    window.location.reload();
            });
        });


    });
</script>