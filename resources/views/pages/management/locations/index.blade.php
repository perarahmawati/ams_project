<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Leaflet's CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    <style>
        #map { height: 300px; width: 400px;}
        #locationPopup { display: none; }
    </style>

</head>
<body>
    <h1>Location</h1>
    <div>
        @if(session()->has('success'))
        <div>
            {{ session('success') }}
        </div>
        @endif
    </div>
    <div>
        <div>
            <a href="{{ route('pages.management.locations.create') }}">Add New</a>
        </div>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Action</th>
            </tr>
            @foreach($locations as $location)
            <tr>
                <td>{{$location->id}}</td>
                <td onmouseover="showLocationPopup('{{ $location->latitude }}', '{{ $location->longitude }}', '{{ $location->name }}', '{{ $location->address }}')" onmouseout="hideLocationPopup()">{{$location->name}}</td>
                <td>{{$location->address}}</td>
                <td>{{$location->latitude}}</td>
                <td>{{$location->longitude}}</td>
                <td>
                    <a href="{{ route('pages.management.locations.edit', ['location' => $location]) }}">Edit</a>
                    <form method="post" action="{{ route('pages.management.locations.destroy', ['location' => $location]) }}">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Delete" />
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <div id="locationPopup">
            <div id="map"></div>
        </div>
    </div>
    <!-- Leaflet's JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        var map;
        var marker;

        function showLocationPopup(latitude, longitude, name, address) {
            document.getElementById('locationPopup').style.display = 'block';
            if (!map) {
                map = L.map('map').setView([latitude, longitude], 18);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                    maxZoom: 18,
                }).addTo(map);
                marker = L.marker([latitude, longitude]).addTo(map).bindPopup(`<b>${name}</b><br>${address}`, {
                    closeButton: false
                }).openPopup();
            } else {
                map.setView([latitude, longitude], 18);
                marker.setLatLng([latitude, longitude]);
                marker.getPopup().setContent(`<b>${name}</b><br>${address}`).openPopup();
            }
        }

        function hideLocationPopup() {
            document.getElementById('locationPopup').style.display = 'none';
        }
    </script>
</body>
</html>