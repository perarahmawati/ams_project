<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/vendor/bootstrap/dist/css/bootstrap.min.css">

    <!-- Leaflet's CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    <style>
        #map { height: 300px; width: 400px;}
        #locationPopup { display: none; }
    </style>
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
            <a href="{{ route('pages.data-tables.create') }}" class="btn btn-primary">Add Data</a>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Import Data
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Import New Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('import-excel') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <p>Download the import template file <a href="{{ asset('/assets/files/import_new_data_template.xlsx') }}">here</a>.</p>
                        </div>
                        <div class="form-group">
                            <input type="file" name="file" required accept=".xls,.xlsx,.csv">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Item</th>
                <th>Manufacturer</th>
                <th>Serial Number</th>
                <th>Configuration Status</th>
                <th>Location</th>
                <th>Description</th>
                <th>Position Status</th>
                <th>Created Date</th>
                <th>Action</th>
            </tr>
            @if($data_tables->isNotEmpty())
            @foreach($data_tables as $data_table)
            <tr>
                <td>{{ $data_table->id }}</td>
                <td>{{ $data_table->item->name }}</td>
                <td>{{ $data_table->manufacturer->name }}</td>
                <td>{{ $data_table->serial_number }}</td>
                <td>{{ $data_table->configurationStatus->name }}</td>
                <td onmouseover="showLocationPopup('{{ $data_table->location->latitude }}', '{{ $data_table->location->longitude }}', '{{ $data_table->location->name }}', '{{ $data_table->location->address }}')" onmouseout="hideLocationPopup()">{{ $data_table->location->name }}</td>
                <td>{{ $data_table->description }}</td>
                <td>{{ $data_table->positionStatus->name }}</td>
                <td>{{ $data_table->created_at }}</td>
                <td>
                    <a href="{{ route('pages.data-tables.show', $data_table->id) }}">Show</a>
                    <a href="{{ route('pages.data-tables.edit', $data_table->id) }}">Edit</a>
                    <form method="post" action="{{ route('pages.data-tables.destroy', $data_table->id) }}">
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

    <!-- Bootstrap JS -->
    <script src="/vendor/bootstrap/dist/js/bootstrap.min.js"></script>

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