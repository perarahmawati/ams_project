@extends('layouts.app')

@section('title', 'ASSET MANAGEMENT')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">ASSET MANAGEMENT</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
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
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection