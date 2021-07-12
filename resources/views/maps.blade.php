@extends('layouts.app')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
  integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
  crossorigin=""/>

@section('content')
        <div class="animated fadeIn">
             <div class="row">
                <div id="map" style="height:88vh; width:100vw"></div>
            </div>
        </div>
</div>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
  integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
  crossorigin=""></script>

<script type="text/javascript">
    var mymap = L.map('map').setView([14.8386, 120.2842], 13.77);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWlrZWVhbmdlbG8iLCJhIjoiY2pob2R0OHFvMGExYTNkbXV4czEybXppdSJ9._4qk-kgx0V8EHvuSrYFuDA', {
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoibWlrZWVhbmdlbG8iLCJhIjoiY2pob2R0OHFvMGExYTNkbXV4czEybXppdSJ9._4qk-kgx0V8EHvuSrYFuDA'
    }).addTo(mymap);

    @foreach($establishment as $e)
      new L.marker(['{{ $e["lat"]}}' , '{{ $e["lng"] }}']).bindPopup('{{ $e["name"] }}').openPopup().addTo(mymap);
    @endforeach
</script>
@endsection
