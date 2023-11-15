<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/vendor/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <h1>Edit Manufacture</h1>
    <div>
        @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        <form method="post" name="dataTableForm" id="dataTableForm" action="">
            @csrf
            @method('post')
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{$manufacture->name}}" />
                <p></p>
            </div>
            <div>
                <input type="submit" value="Update" />
            </div>
        </form>
    </div>

    <!-- JQuery -->
    <script src="/vendor/jquery/jquery.min.js"></script>

    <script type="text/javascript">
        $("#dataTableForm").submit(function(event){
            event.preventDefault();
            $("input[type=submit]").prop('disabled',true);
            $.ajax({
                url: "{{ route('pages.management.manufactures.update', $manufacture->id) }}",
                data: $(this).serializeArray(),
                method: 'post',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(response){
                    $("input[type=submit]").prop('disabled',false);
                    if(response.status == true) {
                        window.location.href="{{ route('pages.management.manufactures.index') }}"; 
                    } else {
                        var errors = response.errors;
                        if (errors.name) {
                            $("#name").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.name)
                        } else {
                            $("#name").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("")
                        }
                    }
                }
            });
        }) ;
    </script>
</body>
</html>