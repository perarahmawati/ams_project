@extends('layouts.app')

@section('title', 'DASHBOARD')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">

          <div class="col-12 col-sm-4 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-box"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">All Assets</span>
                <span class="info-box-number">{{ $all }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-12 col-sm-4 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-question-circle"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Unconfigured</span>
                <span class="info-box-number">{{ $unconfigured }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-4 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Preconfigured</span>
                <span class="info-box-number">{{ $preconfigured }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-12 col-sm-4 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cogs"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Configured</span>
                <span class="info-box-number">{{ $configured }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-4 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-check-circle"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Tested</span>
                <span class="info-box-number">{{ $tested }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          
          <div class="col-12 col-sm-4 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1 text-white"><i class="fas fa-desktop"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Installed</span>
                <span class="info-box-number">{{ $installed }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

        </div>
        <!-- /.row -->

        <!-- TABLE: LATEST ORDERS -->
        <div class="row">
          <div class="col-12 col-sm-12">
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Recent</h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
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
                        </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>
                <!-- /.table-responsive -->

              </div>
            </div>
          </div>
        </div>
        <!-- /.card -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection