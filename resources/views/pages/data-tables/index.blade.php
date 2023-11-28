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
                    <div class="card-header">
                        <h4 class="mb-0">Asset List</h4>
                    </div>
                    <div class="card-body">
                        <div>
                            @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success! </strong>{{ Session::get('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            @if(Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Failed! </strong>{{ Session::get('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            <div id="successAlert"></div>
                            <div class="row mb-4">
                                <div class="col-sm-6">
                                    <a href="{{ route('pages.data-tables.create') }}" class="btn btn-primary mr-1"><i class="fa-solid fa-circle-plus mr-2"></i>Add New Asset</a>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#modal">
                                        <i class="fa-solid fa-file-import mr-2"></i>Import New Asset
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title fs-5" id="modalLabel">Import New Asset Data</h1>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('import-excel') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div>
                                                            <p>Upload an <a href="{{ asset('/assets/files/import_new_data_template.xlsx') }}">Excel</a> file here to import new asset data!</p>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" name="file" class="custom-file-input" id="customFile" required accept=".xls,.xlsx" onchange="updateFileName()">
                                                            <label class="custom-file-label" for="customFile" id="fileLabel">Choose file</label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ route('pages.data-tables.recycle-bin') }}" class="btn btn-primary mr-1"><i class="fa-solid fa-recycle mr-2"></i>Recycle Bin</a>
                                </div>
                                <div class="col-sm-6">
                                    <div class="float-sm-right">
                                        <a href="{{ route('pages.management.index') }}" class="btn btn-warning text-white"><i class="fa-solid fa-list-check mr-2"></i>Option Management</a>
                                    </div>
                                </div>
                            </div>
                            <table id="assetTable" class="table table-bordered table-hover display">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="row-checkbox" id="selectAll"></th>
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
                                    @foreach($data_tables as $data_table)
                                    <tr>
                                        <td><input type="checkbox" class="row-checkbox"></td>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data_table->item->name }}</td>
                                        <td>{{ $data_table->manufacturer->name }}</td>
                                        <td>{{ $data_table->serial_number }}</td>
                                        <td>{{ $data_table->configurationStatus->name }}</td>
                                        <td onclick="toggleLocationPopup('{{ $data_table->location->latitude }}', '{{ $data_table->location->longitude }}', '{{ $data_table->location->name }}', '{{ $data_table->location->address }}')">
                                            <div id="locationPopup">
                                                <div id="map" style="height: 25vh; width: 50vh;"></div>
                                            </div>
                                            {{ $data_table->location->name }}
                                        </td>
                                        <td>{{ $data_table->description }}</td>
                                        <td>{{ $data_table->positionStatus->name }}</td>
                                        <td>{{ $data_table->created_at }}</td>
                                        <td>
                                            <a href="{{ route('pages.data-tables.show', $data_table->id) }}" class="btn btn-primary btn-sm text-white mr-1"><i class="fa-solid fa-eye mr-2"></i>Show</a>
                                            <a href="{{ route('pages.data-tables.edit', $data_table->id) }}" class="btn btn-warning btn-sm text-white mr-1"><i class="fa-solid fa-pen-to-square mr-2"></i>Edit</a>
                                            <a href="{{ route('pages.data-tables.soft-delete', $data_table->id) }}" class="btn btn-danger btn-sm text-white mr-1"><i class="fa-solid fa-trash mr-2"></i>Delete</a>
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

        <script>
            // Fungsi untuk mengubah nama file pada form input Import New Data sesuai dengan nama file yang diupload
            function updateFileName() {
                var fileInput = document.getElementById('customFile');
                var fileName = fileInput.files[0].name;
                var fileLabel = document.getElementById('fileLabel');
                fileLabel.innerHTML = fileName;
            }
        </script>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection