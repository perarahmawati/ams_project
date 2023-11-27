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
                        <a href="{{ route('pages.data-tables.index') }}" class="text-dark"><i class="fa-solid fa-chevron-left mr-2 mt-2"></i></a>
                        <h4 class="m-0">Deleted Asset List</h4>
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
                            <table id="recycleBinTable" class="table table-bordered table-hover">
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
                                        <th>Deleted Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach($data_tables as $data_table)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data_table->item->name }}</td>
                                        <td>{{ $data_table->manufacturer->name }}</td>
                                        <td>{{ $data_table->serial_number }}</td>
                                        <td>{{ $data_table->configurationStatus->name }}</td>
                                        <td>{{ $data_table->location->name }}</td>
                                        <td>{{ $data_table->description }}</td>
                                        <td>{{ $data_table->positionStatus->name }}</td>
                                        <td>{{ $data_table->deleted_at }}</td>
                                        <td>
                                            <a href="{{ route('pages.data-tables.restore', $data_table->id) }}" class="btn btn-warning btn-sm text-white mr-1"><i class="fa-solid fa-recycle mr-2"></i>Restore</a>
                                            <a href="{{ route('pages.data-tables.force-delete', $data_table->id) }}" class="btn btn-danger btn-sm text-white mr-1"><i class="fa-solid fa-trash mr-2"></i>Delete Permanently</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div id="locationPopup">
                                <div id="map" style="height: 50vh; width: 50vh;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection