<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Document</title>

    <!-- Leaflet's CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    <style>
        #map { height: 300px; width: 400px;}
        #locationPopup { display: none; }
    </style>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/vendor/bootstrap/dist/css/bootstrap.min.css">

</head>
<body>
    <h1>Data Table</h1>
    <div>
        @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        <div>
            <a href="{{ route('pages.data-tables.create') }}">Add New</a>
        </div>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Item</th>
                <th>Manufacture</th>
                <th>Serial Number</th>
                <th>Configuration Status</th>
                <th>Location</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            @if($data_tables->isNotEmpty())
            @foreach($data_tables as $data_table)
            <tr>
                <td>{{ $data_table->id }}</td>
                <td>{{ $data_table->item->name }}</td>
                <td>{{ $data_table->manufacture->name }}</td>
                <td>{{ $data_table->serial_number }}</td>
                <td>{{ $data_table->configurationStatus->name }}</td>
                <td onmouseover="showLocationPopup('{{ $data_table->location->latitude }}', '{{ $data_table->location->longitude }}', '{{ $data_table->location->name }}', '{{ $data_table->location->address }}')" onmouseout="hideLocationPopup()">{{ $data_table->location->name }}</td>
                <td>{{ $data_table->description }}</td>
                <td>
                    <a href="{{ route('pages.data-tables.show', $data_table->id) }}">Show</a>
                    <a href="{{ route('pages.data-tables.edit', $data_table->id) }}">Edit</a>
                    <form method="post" action="{{ route('pages.data-tables.destroy', ['data_table' => $data_table]) }}">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Delete" />
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </table>
        <div id="locationPopup">
            <div id="map"></div>
        </div>
    </div>

    <!-- JQuery -->
    <script src="/vendor/jquery/jquery.min.js"></script>

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