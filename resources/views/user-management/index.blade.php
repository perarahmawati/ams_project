@extends('layouts.app')

@section('title', 'ASSET MANAGEMENT')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Log</li> --}}
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">

              <!-- /.card-header -->
              <div class="card-body">
                <div class="row mb-4">
                  <div class="col-sm-12">
                      <a href="#" class="btn btn-primary mr-1"><i class="fa-solid fa-circle-plus mr-2"></i>Add New User</a>
                  </div>
                </div>
                <table id="myTable3" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>No Telpon</th>
                        <th>Role</th>
                        <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $user->name }}</td>             
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->password }}</td>
                        <td>{{ $user->telp }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                          <a href="#" class="btn btn-warning btn-sm text-white mb-2 mr-1"><i class="fa-solid fa-pen-to-square mr-2"></i>Edit</a>
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn btn-danger btn-sm text-white mb-2 mr-1">
                                  <i class="fa-solid fa-trash mr-2"></i> Delete
                              </button>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col-md-6 -->
          
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection