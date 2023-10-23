<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Leaflet's CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/@geoapify/leaflet-address-search-plugin@^1/dist/L.Control.GeoapifyAddressSearch.min.css" />

    <style>
        #map { height: 400px; }
    </style>

</head>
<body>
    <h1>Edit Location</h1>
    <div>
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif
    </div>
    <form method="post" action="{{ route('pages.management.locations.update', ['location' => $location]) }}">
        @csrf
        @method('put')
        <div id="map"></div>
        <div>
            <label>Name</label>
            <input type="text" name="name" id="name" placeholder="Name" value="{{$location->name}}" />
        </div>
        <div>
            <label>Address</label>
            <input type="text" name="address" id="address" placeholder="Address" value="{{$location->address}}" />
        </div>
        <div>
            <label>Latitude</label>
            <input type="text" name="latitude" id="latitude" placeholder="Latitude" value="{{$location->latitude}}" />
        </div>
        <div>
            <label>Longitude</label>
            <input type="text" name="longitude" id="longitude" placeholder="Longitude" value="{{$location->longitude}}" />
        </div>
        <div>
            <input type="submit" value="Update" />
        </div>
    </form>

    <!-- Leaflet's JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/@geoapify/leaflet-address-search-plugin@^1/dist/L.Control.GeoapifyAddressSearch.min.js"></script>

    <script>
        var map = L.map('map').setView([0, 0], 2);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 18,
        }).addTo(map);

        let apiKey = "672e908ef79f41248a4d346a3915c0d2",
            marker = null;

        const addressSearchControl = L.control.addressSearch(apiKey , {
            resultCallback : (address) => {
                if(!address){
                    return;
                }

                if(marker !== null){
                    map.removeLayer(marker);
                }
                
                marker = L.marker([address.lat,address.lon]).addTo(map);
                map.setView([address.lat,address.lon],17)

                document.getElementById('name').value = address.address_line1;
                document.getElementById('address').value = address.address_line2;
                document.getElementById('latitude').value = address.lat;
                document.getElementById('longitude').value = address.lon;
            }
        });

        map.addControl(addressSearchControl);
    </script>
</body>
</html>