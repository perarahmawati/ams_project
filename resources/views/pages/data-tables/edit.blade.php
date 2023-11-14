<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/vendor/bootstrap/dist/css/bootstrap.min.css">

    <!-- Dropzone CSS -->
    <link rel="stylesheet" href="/vendor/dropzone/dropzone.min.css">

    <!-- Phospor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        .image-card{
            position: relative;
        }

        .image-card .btn-danger{
            position: absolute;
            right: 20px;
            top: 20px;
        }
    </style>
</head>
<body>
    <h1>Edit Data</h1>
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
            <label for="item_name">Item</label>
            <select name="item_name" id="item_name" class="form-control">
                <option selected disabled>Select Item</option>
                @foreach ($item_names as $option)
                    <option value="{{ $option->id }}" {{ $data_table->item_name == $option->id ? 'selected' : '' }}>{{ $option->name }}</option>
                @endforeach
            </select>
            <p></p>
        </div>
        <div>
            <label for="manufacture_name">Manufacture</label>
            <select name="manufacture_name" id="manufacture_name" class="form-control">
                <option selected disabled>Select Manufacture</option>
                @foreach ($manufacture_names as $option)
                    <option value="{{ $option->id }}" {{ $data_table->manufacture_name == $option->id ? 'selected' : '' }}>{{ $option->name }}</option>
                @endforeach
            </select>
            <p></p>
        </div>
        <div>
            <label for="serial_number">Serial Number</label>
            <input type="text" name="serial_number" id="serial_number" placeholder="Serial Number" class="form-control" value="{{ $data_table->serial_number }}"></input>
            <p></p>
        </div>
        <div>
            <label for="configuration_status_name">Configuration Status</label>
            <select name="configuration_status_name" id="configuration_status_name" class="form-control">
                <option selected disabled>Select Configuration Status</option>
                @foreach ($configuration_status_names as $option)
                    <option value="{{ $option->id }}" {{ $data_table->configuration_status_name == $option->id ? 'selected' : '' }}>{{ $option->name }}</option>
                @endforeach
            </select>
            <p></p>
        </div>
        <div>
            <label for="location_name">Location</label>
            <select name="location_name" id="location_name" class="form-control">
                <option selected disabled>Select Location</option>
                @foreach ($location_names as $option)
                    <option value="{{ $option->id }}" {{ $data_table->location_name == $option->id ? 'selected' : '' }}>{{ $option->name }}</option>
                @endforeach
            </select>
            <p></p>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea type="text" name="description" id="description" placeholder="Description" class="form-control">{{ $data_table->description }}</textarea>
            <p></p>
        </div>
        <div>
            <label for="position_status_name">Configuration Status</label>
            <select name="position_status_name" id="position_status_name" class="form-control">
                <option selected disabled>Select Configuration Status</option>
                @foreach ($position_status_names as $option)
                    <option value="{{ $option->id }}" {{ $data_table->position_status_name == $option->id ? 'selected' : '' }}>{{ $option->name }}</option>
                @endforeach
            </select>
            <p></p>
        </div>
        <div>
            <h2>Upload Image</h2>
            <div id="image" class="dropzone dz-clickable">
                <div class="dz-message needsclick">
                    <br>Drop files here or click to upload.
                    <br><br>
                </div>
            </div>
        </div>
        <div class="row" id="image-wrapper">
            @if($data_tableImages->isNotEmpty())
                @foreach($data_tableImages as $data_tableImage)
                    <div class="col-md-3 mb-4" id="data-table-image-row-{{ $data_tableImage->image }}">
                        <div class="card image-card">
                            <a href="#" onclick="deleteImage({{ $data_tableImage->id }});" class="btn btn-danger"><i class="ph-bold ph-trash"></i></a>
                            <img src="{{ asset('uploads/data_tables/small/'.$data_tableImage->name) }}" alt="" class="w-100 card-img-top">
                            <div class="card-body">
                                <input type="text" name="caption[]" id="caption" value="{{ $data_tableImage->caption }}" class="form-control" />
                                <input type="hidden" name="image_id[]" id="image_id" value="{{ $data_tableImage->id }}" class="form-control"/>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div>
            <input type="submit" value="Update" />
        </div>
    </form>

    <!-- JQuery -->
    <script src="/vendor/jquery/jquery.min.js"></script>

    <!-- Dropzone JS -->
    <script src="/vendor/dropzone/dropzone.min.js"></script>

    <script type="text/javascript">
        var data_table_id = '{{ $data_table->id }}';
        Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({ 
            uploadprogress: function(file, progress, bytesSent) {
                $("input[type=submit]").prop('disabled',true);
            },
            url:  "{{ route('pages.data-tables.data-table-images.store') }}",
            params: {data_table_id: data_table_id},
            maxFiles: 10,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpg,image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }, success: function(file, response){
                    var html = `<div class="col-md-3 mb-4" id="data-table-image-row-${response.image_id}">
                                    <div class="card image-card">
                                        <a href="#" onclick="deleteImage(${response.image_id});" class="btn btn-danger"><i class="ph-bold ph-trash"></i></a>
                                        <img src="${response.imagePath}" alt="" class="w-100 card-img-top">
                                        <div class="card-body">
                                            <input type="text" name="caption[]" id="caption" value="" class="form-control" />
                                            <input type="hidden" name="image_id[]" id="image_id" value="${response.image_id}" />
                                        </div>
                                    </div>
                                </div>`; 
                    $("#image-wrapper").append(html);
                    $("input[type=submit]").prop('disabled',false);
                this.removeFile(file);            
            }
        });

        $("#dataTableForm").submit(function(event){
            event.preventDefault();
            $("input[type=submit]").prop('disabled',true);
            $.ajax({
                url: "{{ route('pages.data-tables.update',$data_table->id) }}",
                data: $(this).serializeArray(),
                method: 'post',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(response){
                    $("input[type=submit]").prop('disabled',false);
                    if(response.status == true) {
                        window.location.href="{{ route('pages.data-tables.index') }}"; 
                    } else {
                        var errors = response.errors;
                        if (errors.item_name) {
                            $("#item_name").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.item_name)
                        } else {
                            $("#item_name").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("")
                        }

                        if (errors.manufacture_name) {
                            $("#manufacture_name").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.manufacture_name)
                        } else {
                            $("#manufacture_name").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("")
                        }

                        if (errors.serial_number) {
                            $("#serial_number").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.serial_number)
                        } else {
                            $("#serial_number").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("")
                        }

                        if (errors.configuration_status_name) {
                            $("#configuration_status_name").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.configuration_status_name)
                        } else {
                            $("#configuration_status_name").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("")
                        }

                        if (errors.location_name) {
                            $("#location_name").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.location_name)
                        } else {
                            $("#location_name").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("")
                        }

                        if (errors.description) {
                            $("#description").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.description)
                        } else {
                            $("#description").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("")
                        }

                        if (errors.position_status_name) {
                            $("#position_status_name").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.position_status_name)
                        } else {
                            $("#position_status_name").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("")
                        }
                    }
                }
            });
        }) ;
        
        function deleteImage(id){
            if (confirm("Are you sure you want to delete?")) {
                var URL = "{{ route('pages.data-tables.data-table-images.destroy','ID') }}";
                newURL = URL.replace('ID',id)

                $("#data-table-image-row-"+id).remove();

                $.ajax({
                    url: newURL,
                    data: {},
                    method: 'delete',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success: function(response){
                        window.location.href='{{ route("pages.data-tables.edit",$data_table->id) }}';
                    }
                });
            }
        }
    </script>
</body>
</html>