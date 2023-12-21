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
            <h1 class="m-0">Asset Management</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <a href="#" onclick="history.back();" class="text-dark"><i class="fa-solid fa-chevron-left mr-2 mt-2"></i></a>
                        <h4 class="m-0">Filtered Asset List</h4>
                    </div>
                    <div class="card-body">
                        <div>
                            <table id="filteredAssetTable" class="table table-bordered table-hover display">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Item</th>
                                        <th>Manufacturer</th>
                                        <th>Serial Number</th>
                                        <th>Configuration Status</th>
                                        <th>Location</th>
                                        <th>Description</th>
                                        <th>Position Status</th>
                                        <th>Created Date</th>
                                        <th class="no-export">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach($location_tables as $location_table)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $location_table->item->name }}</td>
                                        <td>{{ $location_table->manufacturer->name }}</td>
                                        <td>{{ $location_table->serial_number }}</td>
                                        <td>{{ $location_table->configurationStatus->name }}</td>
                                        <td onclick="toggleLocationPopup('{{ $location_table->location->latitude }}', '{{ $location_table->location->longitude }}', '{{ $location_table->location->name }}', '{{ $location_table->location->address }}')">
                                            <div id="locationPopup">
                                                <div id="map" style="height: 25vh; width: 50vh;"></div>
                                            </div>
                                            {{ $location_table->location->name }}
                                        </td>
                                        <td>{{ $location_table->description }}</td>
                                        <td>{{ $location_table->positionStatus->name }}</td>
                                        <td>{{ $location_table->created_at }}</td>
                                        <td>
                                            <a href="{{ route('pages.data-tables.filter-results.location.show', $location_table->id) }}" class="btn btn-primary btn-sm text-white mr-1"><i class="fa-solid fa-eye mr-2"></i>Show</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>

        <!-- Leaflet -->
        <script src="{{ asset('adminlte/plugins/leaflet/leaflet.js') }}"></script>

        <script>
            var map;
            var marker;

            // Fungsi toggle untuk menampilkan atau menyembunyikan popup
            function toggleLocationPopup(latitude, longitude, name, address) {
                var locationPopup = document.getElementById('locationPopup');
                if (locationPopup.style.display === 'block') {
                    hideLocationPopup();
                } else {
                    showLocationPopup(latitude, longitude, name, address);
                }
            }

            // Fungsi untuk menampilkan popup
            function showLocationPopup(latitude, longitude, name, address) {
                document.getElementById('locationPopup').style.display = 'block';
                if (!map) {
                    map = L.map('map').setView([latitude, longitude], 18);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                        maxZoom: 18,
                    }).addTo(map);
                    marker = L.marker([latitude, longitude]).addTo(map).bindPopup(`<center><b>${name}</b><br>${address}</center>`, {
                        closeButton: false
                    }).openPopup();
                } else {
                    map.setView([latitude, longitude], 18);
                    marker.setLatLng([latitude, longitude]);
                    marker.getPopup().setContent(`<center><b>${name}</b><br>${address}</center>`).openPopup();
                }

                // Tambahkan event listener untuk menutup popup saat mengklik di luar
                document.addEventListener('mousedown', closePopupOutside);
            }

            // Fungsi untuk menyembunyikan popup
            function hideLocationPopup() {
                document.getElementById('locationPopup').style.display = 'none';

                // Hapus event listener setelah menyembunyikan popup
                document.removeEventListener('mousedown', closePopupOutside);
            }

            // Fungsi untuk menutup popup saat mengklik di luar
            function closePopupOutside(event) {
                var locationPopup = document.getElementById('locationPopup');
                var targetElement = event.target; // Element yang diklik

                // Periksa apakah yang diklik bukan bagian dari locationPopup
                if (!locationPopup.contains(targetElement)) {
                    hideLocationPopup();
                }
            }
        </script>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection