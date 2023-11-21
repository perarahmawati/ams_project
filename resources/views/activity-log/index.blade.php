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
            <h1>Activity Log</h1>
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
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Event</th>
                        <th>Subject ID</th>
                        <th>Causer Type</th>
                        <th>Created</th>
                        <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($logactivities as $log)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $log->users->name }}</td>             
                        <td>{{ $log->event }}</td>
                        <td>{{ $log->subject_id }}</td>
                        <td>{{ $log->causer_type }}</td>
                        <td>{{ $log->created_at }}</td>
                        <td>
                            @if ($log->event == 'updated')
                              <a class="btn btn-block btn-outline-dark" href="{{ route('pages.data-tables.log',$log->subject_id) }}">Detail</a>
                            @elseif ($log->event == 'deleted')
                              <a class="btn btn-block btn-outline-dark" href="{{ route('pages.data-tables.log',$log->subject_id) }}">Detail</a>
                            @else
                              <a class="btn btn-block btn-outline-dark" href="{{ route('pages.data-tables.log',$log->subject_id) }}">Detail</a>
                              {{-- {{ $log->description }} --}}
                            @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="row text-center">
                    {!! $logactivities->links() !!}
                </div>
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

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('adminLTE/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- DataTables  & Plugins -->
<script src="{{ asset('adminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('adminLTE/dist/js/adminlte.min.js') }}"></script>

<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ asset('adminLTE/dist/js/demo.js') }}"></script> --}}

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

</body>
</html>
 
