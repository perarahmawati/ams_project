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
    <h1>Manufacture</h1>
    <div>
        @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        <div>
            <div>
                <a href="{{ route('pages.management.manufactures.create') }}" class="btn btn-primary">Add Manufacture</a>
            </div>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                @if($manufactures->isNotEmpty())
                @foreach($manufactures as $manufacture)
                <tr>
                    <td>{{$manufacture->id}}</td>
                    <td>{{$manufacture->name}}</td>
                    <td>
                        <a href="{{ route('pages.management.manufactures.edit', $manufacture->id) }}">Edit</a>
                        <form method="post" action="{{ route('pages.management.manufactures.destroy', $manufacture->id) }}">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" />
                        </form>
                    </td>
                </tr>
                @endforeach
                @endif
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="/vendor/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- JQuery -->
    <script src="/vendor/jquery/jquery.min.js"></script>
</body>
</html>