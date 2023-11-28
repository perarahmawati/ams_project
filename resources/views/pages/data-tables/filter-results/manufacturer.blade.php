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
                        <a href="{{ route('pages.dashboard') }}" class="text-dark"><i class="fa-solid fa-chevron-left mr-2 mt-2"></i></a>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach($manufacturer_tables as $manufacturer_table)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $manufacturer_table->item->name }}</td>
                                        <td>{{ $manufacturer_table->manufacturer->name }}</td>
                                        <td>{{ $manufacturer_table->serial_number }}</td>
                                        <td>{{ $manufacturer_table->configurationStatus->name }}</td>
                                        <td onclick="toggleLocationPopup('{{ $manufacturer_table->location->latitude }}', '{{ $manufacturer_table->location->longitude }}', '{{ $manufacturer_table->location->name }}', '{{ $manufacturer_table->location->address }}')">
                                            <div id="locationPopup">
                                                <div id="map" style="height: 25vh; width: 50vh;"></div>
                                            </div>
                                            {{ $manufacturer_table->location->name }}
                                        </td>
                                        <td>{{ $manufacturer_table->description }}</td>
                                        <td>{{ $manufacturer_table->positionStatus->name }}</td>
                                        <td>{{ $manufacturer_table->created_at }}</td>
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