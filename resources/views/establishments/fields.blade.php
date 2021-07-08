<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
  integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
  crossorigin=""/>
<div class="row">
    <div class="col-6">
        <!-- Type Field -->
        <div class="form-group col-sm-10">
            {!! Form::label('Type:', 'Type:') !!}
            {!! Form::select('type', ['Stall','Shop','Fastfood','Mall','Grocery','Supermarket','Hospital'], ['class' =>
            'form-control']) !!}
        </div>

        <!-- Name Field -->
        <div class="form-group col-sm-10">
            {!! Form::label('name', 'Establishment Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Staff Name Field -->
        <div class="form-group col-sm-10">
            {!! Form::label('staff_name', 'Staff Name:') !!}
            {!! Form::text('staff_name', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Address Field -->
        <div class="form-group col-sm-10">
            {!! Form::label('address', 'Address:') !!}
            {!! Form::text('address', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Contact No Field -->
        <div class="form-group col-sm-10">
            {!! Form::label('contact_no', 'Contact No:') !!}
            {!! Form::number('contact_no', null, ['class' => 'form-control']) !!}
        </div>

        <div class="row col-sm-12">
        <!-- Contact No Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('lng', 'Longitude:') !!}
            {!! Form::number('lng', null, ['class' => 'form-control', 'readonly']) !!}
        </div>
        <!-- Contact No Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('lat', 'Latitude:') !!}
            {!! Form::number('lat', null, ['class' => 'form-control', 'readonly']) !!}
        </div>

        </div>

        <!-- Submit Field -->
        <div class="form-group col-sm-10">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('establishments.index') }}" class="btn btn-secondary">Cancel</a>
        </div>

    </div>

    <div class="col-6">
        <p>Mark place to get the coordinate of an establishment</p>
        <div id="map" class="col-12" style="height: 90%"></div>
    </div>
</div>


<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
  integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
  crossorigin=""></script>

<script type="text/javascript">
    var lng = document.getElementById('lng');
    var lat = document.getElementById('lat');
    var mymap = L.map('map').setView([14.8386, 120.2842], 20);

    var marker;
    
    mymap.on("click", function(e){
        if(marker) { 
            mymap.removeLayer(marker);
        }
        marker = new L.Marker(e.latlng).addTo(mymap);
        lat.value = e.latlng.lat;
        lng.value = e.latlng.lng;

    });
 
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWlrZWVhbmdlbG8iLCJhIjoiY2pob2R0OHFvMGExYTNkbXV4czEybXppdSJ9._4qk-kgx0V8EHvuSrYFuDA', {
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoibWlrZWVhbmdlbG8iLCJhIjoiY2pob2R0OHFvMGExYTNkbXV4czEybXppdSJ9._4qk-kgx0V8EHvuSrYFuDA'
    }).addTo(mymap);
</script>
