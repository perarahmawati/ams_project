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
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <a href="{{ route('pages.data-tables.index') }}" class="text-dark"><i class="fa-solid fa-chevron-left mr-2 mt-2"></i></a>
                        <h4 class="m-0">Option List</h4>
                    </div>
                    <div class="card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="item-tab" data-toggle="pill" href="#item" role="tab" aria-controls="item" aria-selected="true"><b>Item</b></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="manufacturer-tab" data-toggle="pill" href="#manufacturer" role="tab" aria-controls="manufacturer" aria-selected="false"><b>Manufacturer</b></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="configuration-status-tab" data-toggle="pill" href="#configuration-status" role="tab" aria-controls="configuration-status" aria-selected="false"><b>Configuration Status</b></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="location-tab" data-toggle="pill" href="#location" role="tab" aria-controls="location" aria-selected="false"><b>Location</b></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="position-status-tab" data-toggle="pill" href="#position-status" role="tab" aria-controls="position-status" aria-selected="false"><b>Position Status</b></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="tabContent">
                                <div class="tab-pane fade show active" id="item" role="tabpanel" aria-labelledby="item-tab">
                                    <div>
                                        @if(Session::has('success-item'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Success! </strong>{{ Session::get('success-item') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                        @if(Session::has('error-item'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Failed! </strong>{{ Session::get('error-item') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                        <div class="row mb-4">
                                            <div class="col-sm-12">
                                                <a href="{{ route('pages.option-management.items.create') }}" class="btn btn-primary mr-1"><i class="fa-solid fa-circle-plus mr-2"></i>Add New Item</a>
                                            </div>
                                        </div>
                                        <table id="itemTable" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Created Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach($items as $item)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->created_at }}</td>
                                                    <td>
                                                        <a href="{{ route('pages.option-management.items.edit', $item->id) }}" class="btn btn-warning btn-sm text-white mr-1"><i class="fa-solid fa-pen-to-square mr-2"></i>Edit</a>
                                                        <a href="{{ route('pages.option-management.items.destroy', $item->id) }}" class="btn btn-danger btn-sm text-white mr-1"><i class="fa-solid fa-trash mr-2"></i>Delete</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="manufacturer" role="tabpanel" aria-labelledby="manufacturer-tab">
                                    <div>
                                        @if(Session::has('success-manufacturer'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Success! </strong>{{ Session::get('success-manufacturer') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                        @if(Session::has('error-manufacturer'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Failed! </strong>{{ Session::get('error-manufacturer') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                        <div class="row mb-4">
                                            <div class="col-sm-12">
                                                <a href="{{ route('pages.option-management.manufacturers.create') }}" class="btn btn-primary mr-1"><i class="fa-solid fa-circle-plus mr-2"></i>Add New Manufacturer</a>
                                            </div>
                                        </div>
                                        <table id="manufacturerTable" class="table table-bordered table-hover responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Created Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach($manufacturers as $manufacturer)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $manufacturer->name }}</td>
                                                    <td>{{ $manufacturer->created_at }}</td>
                                                    <td>
                                                        <a href="{{ route('pages.option-management.manufacturers.edit', $manufacturer->id) }}" class="btn btn-warning btn-sm text-white mr-1"><i class="fa-solid fa-pen-to-square mr-2"></i>Edit</a>
                                                        <a href="{{ route('pages.option-management.manufacturers.destroy', $manufacturer->id) }}" class="btn btn-danger btn-sm text-white mr-1"><i class="fa-solid fa-trash mr-2"></i>Delete</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="configuration-status" role="tabpanel" aria-labelledby="configuration-status-tab">
                                    <div>
                                        @if(Session::has('success-configuration-status'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Success! </strong>{{ Session::get('success-configuration-status') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                        @if(Session::has('error-configuration-status'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Failed! </strong>{{ Session::get('error-configuration-status') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                        <div class="row mb-4">
                                            <div class="col-sm-12">
                                                <a href="{{ route('pages.option-management.configuration-statuses.create') }}" class="btn btn-primary mr-1"><i class="fa-solid fa-circle-plus mr-2"></i>Add New Configuration Status</a>
                                            </div>
                                        </div>
                                        <table id="configurationStatusTable" class="table table-bordered table-hover responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Created Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach($configuration_statuses as $configuration_status)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $configuration_status->name }}</td>
                                                    <td>{{ $configuration_status->created_at }}</td>
                                                    <td>
                                                        <a href="{{ route('pages.option-management.configuration-statuses.edit', $configuration_status->id) }}" class="btn btn-warning btn-sm text-white mr-1"><i class="fa-solid fa-pen-to-square mr-2"></i>Edit</a>
                                                        <a href="{{ route('pages.option-management.configuration-statuses.destroy', $configuration_status->id) }}" class="btn btn-danger btn-sm text-white mr-1"><i class="fa-solid fa-trash mr-2"></i>Delete</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab">
                                    <div>
                                            @if(Session::has('success-location'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>Success! </strong>{{ Session::get('success-location') }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            @endif
                                            @if(Session::has('error-location'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>Failed! </strong>{{ Session::get('error-location') }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            @endif
                                            <div class="row mb-4">
                                                <div class="col-sm-12">
                                                    <a href="{{ route('pages.option-management.locations.create') }}" class="btn btn-primary mr-1"><i class="fa-solid fa-circle-plus mr-2"></i>Add New Location</a>
                                                </div>
                                            </div>
                                            <table id="locationTable" class="table table-bordered table-hover responsive-table">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Name</th>
                                                        <th>Address</th>
                                                        <th>Latitude</th>
                                                        <th>Longitude</th>
                                                        <th>Created Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $no = 1;
                                                    @endphp
                                                    @foreach($locations as $location)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $location->name }}</td>
                                                        <td>{{ $location->address }}</td>
                                                        <td>{{ $location->latitude }}</td>
                                                        <td>{{ $location->longitude }}</td>
                                                        <td>{{ $location->created_at }}</td>
                                                        <td>
                                                            <a href="{{ route('pages.option-management.locations.edit', $location->id) }}" class="btn btn-warning btn-sm text-white mr-1"><i class="fa-solid fa-pen-to-square mr-2"></i>Edit</a>
                                                            <a href="{{ route('pages.option-management.locations.destroy', $location->id) }}" class="btn btn-danger btn-sm text-white mr-1"><i class="fa-solid fa-trash mr-2"></i>Delete</a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                <div class="tab-pane fade" id="position-status" role="tabpanel" aria-labelledby="position-status-tab">
                                    <div>
                                        @if(Session::has('success-position-status'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Success! </strong>{{ Session::get('success-position-status') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                        @if(Session::has('error-position-status'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Failed! </strong>{{ Session::get('error-position-status') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                        <div id="successAlert"></div>
                                        <div class="row mb-4">
                                            <div class="col-sm-12">
                                                <a href="{{ route('pages.option-management.position-statuses.create') }}" class="btn btn-primary mr-1"><i class="fa-solid fa-circle-plus mr-2"></i>Add New Position Status</a>
                                            </div>
                                        </div>
                                        <table id="positionStatusTable" class="table table-bordered table-hover responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Created Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach($position_statuses as $position_status)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $position_status->name }}</td>
                                                    <td>{{ $position_status->created_at }}</td>
                                                    <td>
                                                        <a href="{{ route('pages.option-management.position-statuses.edit', $position_status->id) }}" class="btn btn-warning btn-sm text-white mr-1"><i class="fa-solid fa-pen-to-square mr-2"></i>Edit</a>
                                                        <a href="{{ route('pages.option-management.position-statuses.destroy', $position_status->id) }}" class="btn btn-danger btn-sm text-white mr-1"><i class="fa-solid fa-trash mr-2"></i>Delete</a>
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
                    <!-- /.card -->
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const lastOpenedTab = localStorage.getItem('lastOpenedTab');

                if (lastOpenedTab) {
                    $('.nav-tabs a[href="#' + lastOpenedTab + '"]').tab('show');
                }

                $('.nav-tabs a').on('shown.bs.tab', function (event) {
                    const activeTab = event.target.getAttribute('href').substring(1);
                    localStorage.setItem('lastOpenedTab', activeTab);
                });
            });
        </script>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection